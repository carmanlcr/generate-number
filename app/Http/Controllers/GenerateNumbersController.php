<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NumberGenerateRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ExcelController;
use App\State;
use App\Zone;
use App\Number;
use App\AreaCode;
use App\Phone;
use App\Exports\PhonesExport;
use App\VicidialModel\VicidialList;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Jobs\InsertVicidial;

class GenerateNumbersController extends Controller
{
    use Queueable, SerializesModels;
	/**
	*	
	*
	* @return view 
	*/
    public function index(){
    	return view('generate.generate');
    }

    public function generador(){
        \Artisan::call('cache:clear');
        $zonas = array(1000,2000,3000,4000);
        $countZone = DB::connection('asterisk')->select('CALL numberCounterByZone');
        

        foreach ($countZone as $key => $value) {
            
            $countZone[$key] = get_object_vars($value) ;
            foreach ($zonas as $k => $zona) {
                if($zona == $value->list_id){
                    unset($zonas[$k]);
                }
            }
            
        }
        foreach ($zonas as $key => $zona) {
            array_push ($countZone, ['list_id' => $zona , 'count' => 0]);
        }
        sort($countZone);
        return response()->json([
            'array' => $countZone
        ]);
    }

    function generate(Request $request){
        \Debugbar::info($request);
    	//Buscar los codigos de area para todos los estados seleccionados
    	$areaCodes = $this->searchAreaCode($request->state);
    	//Buscar los numeros a seleccionar
    	if(is_null($request->quantity) || $request->quantity == 0){
    		
    		$numbers = $this->searchNumbers(7,(int)25000/count($areaCodes));
    	}else{
    		
    		$numbers = $this->searchNumbers(7,(int)$request->quantity/count($areaCodes));

    	}
    	//Buscar si ya existen los numeros en la base de datos
    	$date = $this->validateNumberBD($areaCodes,$numbers);

    	//

    	\Session::flash('mensaje-success', 'Ya puede descargar tu archivo');
    	return view('prueba')
    			->with('date',$date);
    }

    /**
    *
    *
    * @version 1.0.0
    * @author Luis Morales
    * @param $zonas array
    * @return $areaCodes Collection
    */
    private function searchAreaCode($zonas){
    	//Transformación de STATES_ID a query
    	$queryStates = array();
    	foreach ($zonas as $key => $value) {
    		foreach ($value as $k => $valor) {
    			
    			$queryStates[] = $k;
    		}
    	}

    	//Transformación de ZONES_ID a query
    	$queryZone = array();
    	foreach ($zonas as $key => $value) {
    		$queryZone[] = $key;
     	}
     	
    	
    	$areaCodes = AreaCode::join('STATESZONE', function($join) use ($queryStates,$queryZone){
    				$join->on('AREACODES.STATESZONE_ID','=','STATESZONE.STATESZONE_ID')
    				->whereIn('ZONES_ID',$queryZone)
    				->whereIn('STATES_ID',$queryStates);
    			})->join('STATES','STATES.STATES_ID','=','STATESZONE.STATES_ID')
        ->get(['AREACODES.CODE','AREACODES.AREACODES_ID','STATESZONE.ZONES_ID','STATES.NAME']);

    	return $areaCodes;
    			
    }

    /**
    * @version 1.0.0
    * @author Luis Morales
    * @param $length int, $quantity int
    * @return $array array
    */

    private function searchNumbers($length, $quantity) { 
    	$array = array();
    	$validator = '';
    	for ($i=0; $i < $quantity ; $i++) { 
    		$validator = substr(str_shuffle("0123456789"), 0, $length); 
    		if(!in_array($validator, $array)){
    			$array[] = $validator;
    		}else{
    			$i--;
    		}

    	}
   		return $array; 
	} 

	private function validateNumberBD($areaCodes,$numbers){
		$arrayAreaCodesId = array();
        $arrayAreaCodes = array();
		foreach ($areaCodes as $key => $value) {
			$arrayAreaCodesId[] = $value->AREACODES_ID;
            $arrayAreaCodes['CODE'][] = $value->CODE;
            $arrayAreaCodes['ZONE'][] = $value->ZONES_ID;
            $arrayAreaCodes['CITY'][] = $value->NAME;
		}

		$consultArrayPhone = array();
        $consultArray = array();
		
		for($i = 0; $i < count($numbers); $i++){
			for($j = 0; $j < count($arrayAreaCodesId);$j++){

				$consultArrayPhone[] = (['PHONE' => $numbers[$i],'AREACODES_ID' => $arrayAreaCodesId[$j]]);
			}
			
		}

        for($i = 0; $i < count($numbers); $i++){
            for($j = 0; $j < count($arrayAreaCodes['CODE']);$j++){
                $consultArray[] = (['phone_number' => $arrayAreaCodes['CODE'][$j].$numbers[$i], 'zona' => $arrayAreaCodes['ZONE'][$j],
                    'city' => $arrayAreaCodes['CITY'][$j]]);
            }
            
        }

        //Generación de colas para la inserción en la base de datos.

       /*$queue = new InsertVicidial($consultArray);
       dispatch($queue);*/
        VicidialList::insertIgnore($consultArray);
		$searchOrCreate = Phone::insertIgnore($consultArrayPhone);

		if($searchOrCreate){

			return $searchOrCreate;

		}

		
	}  





}

