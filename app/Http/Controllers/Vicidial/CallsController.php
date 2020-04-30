<?php

namespace App\Http\Controllers\Vicidial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Call;
class CallsController extends Controller
{
    public function index(){
        
        return view('calls.index');

    }

    public function calls(){


    	$date = Carbon::now();
        Carbon::setLocale('es');
    	$dateD = $date->formatLocalized('%A %d %B %Y');
        $dateFormatBD = $date->format('Y-m-d');
		$dateTimePrevious = $date->subHour()->format('Y-m-d H:00:00');
        $dateCurrent = $date->format('Y-m-d H:i:s');
		$dateTimeCurrent = Carbon::now()->format('Y-m-d H:00:00');
		$timePrevious = Carbon::now()->subHour()->format('H:00');
		$timeCurrent = Carbon::now()->format('H:00');
		$hora = 'DE '.$timePrevious.' A '.$timeCurrent;
        $day= date('w', strtotime($date));
       
        if($day >= 1 AND $day < 6){
            $dateWhere = $date->format('Y-m-d 09:00:00');
            if($dateTimeCurrent >= $dateWhere){

                $arrayTime = array(['HORA' => 'DE 09:00 A 10:00', 'dateTimeP' => $dateFormatBD.' 09:00:00', 'dateTimeC' => $dateFormatBD.' 10:00:00'],
                    ['HORA' => 'DE 10:00 A 11:00', 'dateTimeP' => $dateFormatBD.' 10:00:00', 'dateTimeC' => $dateFormatBD.' 11:00:00'],
                    ['HORA' => 'DE 11:00 A 12:00', 'dateTimeP' => $dateFormatBD.' 11:00:00', 'dateTimeC' => $dateFormatBD.' 12:00:00'],
                    ['HORA' => 'DE 12:00 A 13:00', 'dateTimeP' => $dateFormatBD.' 12:00:00', 'dateTimeC' => $dateFormatBD.' 13:00:00'],
                    ['HORA' => 'DE 13:00 A 14:00', 'dateTimeP' => $dateFormatBD.' 13:00:00', 'dateTimeC' => $dateFormatBD.' 14:00:00'],
                    ['HORA' => 'DE 14:00 A 15:00', 'dateTimeP' => $dateFormatBD.' 14:00:00', 'dateTimeC' => $dateFormatBD.' 15:00:00'],
                    ['HORA' => 'DE 15:00 A 16:00', 'dateTimeP' => $dateFormatBD.' 15:00:00', 'dateTimeC' => $dateFormatBD.' 16:00:00'],
                    ['HORA' => 'DE 16:00 A 17:00', 'dateTimeP' => $dateFormatBD.' 16:00:00', 'dateTimeC' => $dateFormatBD.' 17:00:00'],
                    ['HORA' => 'DE 17:00 A 18:00', 'dateTimeP' => $dateFormatBD.' 17:00:00', 'dateTimeC' => $dateFormatBD.' 18:00:00']);
                $this->insertHoursFaltant($arrayTime,$dateTimeCurrent,$dateWhere,$dateCurrent);
                $cal = Call::select('DATE','ONE','TWO','THREE','THREE_TO_FIVE','MORE_THAN_FIVE')
                        ->whereRaw('created_at >= ?',$dateWhere)
                        ->get()->toArray();
                sort($cal);
                return response()->json(['calls' => $cal,'date' => $dateD]);
            }
            
        }else if($day == 6){
            $dateWhere = $date->format('Y-m-d 08:00:00');
            if($dateTimeCurrent >= $dateWhere){
                $arrayTime = array(['HORA' => 'DE 08:00 A 09:00', 'dateTimeP' => $dateFormatBD.    ' 08:00:00', 'dateTimeC' => $dateFormatBD.' 09:00:00'],
                    ['HORA' => 'DE 09:00 A 10:00', 'dateTimeP' => $dateFormatBD.' 09:00:00', 'dateTimeC' => $dateFormatBD.' 10:00:00'],
                    ['HORA' => 'DE 10:00 A 11:00', 'dateTimeP' => $dateFormatBD.' 10:00:00', 'dateTimeC' => $dateFormatBD.' 11:00:00'],
                    ['HORA' => 'DE 11:00 A 12:00', 'dateTimeP' => $dateFormatBD.' 11:00:00', 'dateTimeC' => $dateFormatBD.' 12:00:00'],
                    ['HORA' => 'DE 12:00 A 13:00', 'dateTimeP' => $dateFormatBD.' 12:00:00', 'dateTimeC' => $dateFormatBD.' 13:00:00'],
                    ['HORA' => 'DE 13:00 A 14:00', 'dateTimeP' => $dateFormatBD.' 13:00:00', 'dateTimeC' => $dateFormatBD.' 14:00:00']);
                $this->insertHoursFaltant($arrayTime,$dateTimeCurrent,$dateWhere,$dateCurrent);
                $cal = Call::select('DATE','ONE','TWO','THREE','THREE_TO_FIVE','MORE_THAN_FIVE')
                        ->whereRaw('created_at >= ?',$dateWhere)
                        ->get()->toArray();
                sort($cal);
                return response()->json(['calls' => $cal,'date' => $dateD]); 
            }
        }
        
    }

    public function insertHoursFaltant($arrayTime,$dateTimeCurrent,$dateWhere,$dateCurrent){
        $arraySearch = array();
        for($i = 0; $i < count($arrayTime);$i++){

            if($arrayTime[$i]['dateTimeP'] == $dateTimeCurrent){
                break;
            }else{

                $arraySearch[] = $arrayTime[$i];
            }
        }

        for($j = 0; $j < count($arraySearch);$j++){
            $hora = $arraySearch[$j]['HORA'];
            $dateTimePrevious = $arraySearch[$j]['dateTimeP'];
            $dateTimeCurrent = $arraySearch[$j]['dateTimeC'];
            $call = $this->getCountCallsForHours($hora,$dateTimePrevious,$dateTimeCurrent);
            $this->searchOrCreate($call,$dateWhere,$dateCurrent);

        }
    }
    public function searchOrCreate($call,$dateWhere,$dateCurrent){
    	$calls = Call::firstOrCreate(['DATE' => $call[0]->DATE,
        								'CREATED_AT' => $dateWhere],
                            ['ONE' => utf8_encode($call[0]->ONE),
                             'TWO' => utf8_encode($call[0]->TWO),
                             'THREE' => utf8_encode($call[0]->THREE),
                             'THREE_TO_FIVE' => utf8_encode($call[0]->THREE_TO_FIVE),
                             'MORE_THAN_FIVE' => utf8_encode($call[0]->MORE_THAN_FIVE),
                             'UPDATED_AT' => $dateCurrent]);

    }

    public function getCountCallsForHours($hora,$dateTimePrevious,$dateTimeCurrent){
    	return DB::connection('asterisk')->table('vicidial_log')
                ->select(DB::raw("'$hora' as DATE"),DB::raw('COUNT(CASE WHEN   vicidial_log.length_in_sec < 60 then 1 ELSE NULL END) as ONE,
                    COUNT(CASE WHEN vicidial_log.length_in_sec >60 and vicidial_log.length_in_sec < 121 then 1 ELSE NULL END) as TWO,
                    COUNT(CASE WHEN vicidial_log.length_in_sec >120 and vicidial_log.length_in_sec < 181 then 1 ELSE NULL END) as THREE,
                    COUNT(CASE WHEN vicidial_log.length_in_sec >181 and vicidial_log.length_in_sec < 301 then 1 ELSE NULL END) as THREE_TO_FIVE,
                    COUNT(CASE WHEN vicidial_log.length_in_sec > 300 then 1 ELSE NULL END) as MORE_THAN_FIVE'))
                ->whereRaw('vicidial_log.call_date >= ?',$dateTimePrevious)
                ->whereRaw('vicidial_log.call_date <= ?',$dateTimeCurrent)
                ->whereRaw('vicidial_log.campaign_id = ?','08032019')
                ->get()
                ->toArray();
    }


}
