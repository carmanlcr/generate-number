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
		$dateD = $date->format('Y-m-d');
		$dateWhere = $date->format('Y-m-d 00:00:00');
		$dateTimePrevious = $date->subHour()->format('Y-m-d H:00:00');
		$dateTimeCurrent = Carbon::now()->format('Y-m-d H:00:00');
		$timePrevious = Carbon::now()->subHour()->format('H:00');
		$timeCurrent = Carbon::now()->format('H:00');
		$hora = 'DE '.$timePrevious.' A '.$timeCurrent;
    	$call = DB::connection('asterisk')->table('call_log')
                ->select(DB::raw("'$hora' as DATE"),DB::raw('COUNT(CASE WHEN length_in_sec < 60 then 1 ELSE NULL END) as ONE,
                            COUNT(CASE WHEN length_in_sec >60 and length_in_sec < 121 then 1 ELSE NULL END) as TWO,
                            COUNT(CASE WHEN length_in_sec >120 and length_in_sec < 181 then 1 ELSE NULL END) as THREE,
                            COUNT(CASE WHEN length_in_sec >181 and length_in_sec < 301 then 1 ELSE NULL END) as THREE_TO_FIVE,
                            COUNT(CASE WHEN length_in_sec > 300 then 1 ELSE NULL END) as MORE_THAN_FIVE'))
                ->whereRaw('start_time >= ?',$dateTimePrevious)
                ->whereRaw('start_time <= ?',$dateTimeCurrent)
                ->get()
                ->toArray();
        
        \Debugbar::info($call);
        $calls = Call::firstOrNew(array('DATE' => utf8_encode($call[0]->DATE),
        								'created_at' => $dateWhere));
        $calls->DATE = utf8_encode($call[0]->DATE);
        $calls->ONE = utf8_encode($call[0]->ONE);
        $calls->TWO = utf8_encode($call[0]->TWO);
        $calls->THREE = utf8_encode($call[0]->THREE);
        $calls->THREE_TO_FIVE = utf8_encode($call[0]->THREE_TO_FIVE);
        $calls->MORE_THAN_FIVE = utf8_encode($call[0]->MORE_THAN_FIVE);
        $calls->created_at = utf8_encode($dateWhere);
        $calls->save();

        $cal = Call::select('DATE','ONE','TWO','THREE','THREE_TO_FIVE','MORE_THAN_FIVE')
                	->whereRaw('created_at >= ?',$dateWhere)
                	->get();
    	return response()->json(['calls' => $cal,'date' => $dateD]);
    }
}
