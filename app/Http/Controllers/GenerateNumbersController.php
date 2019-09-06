<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NumberGenerateRequest;
use Illuminate\Support\Facades\DB;
use App\State;
use App\Zone;
use App\Number;
use App\AreaCode;
use App\Phone;

class GenerateNumbersController extends Controller
{

	/**
	*	
	*
	* @return view 
	*/
    public function index(){
    	$zonas = DB::table('zones')
    			->select('ZONES_ID', 'NAME')
    			->get();
    	$states = State::with('zones')->orderBy('NAME','ASC')->get();
    	
    	//$numeros = $this->generate();
    	return view('generate.generate')
    			->with('zonas',$zonas)
    			->with('states',$states);
    }

    public function create(){

    }

    function generate(Request $request){
    	//Buscar los codigos de area para todos los estados seleccionados
    	$areaCodes = $this->searchAreaCode($request->state);
    	//Buscar los numeros a seleccionar
    	if(is_null($request->quantity) || $request->quantity == 0){
    		
    		$numbers = $this->searchNumbers(7,(int)25000/count($areaCodes));
    	}else{
    		
    		$numbers = $this->searchNumbers(7,(int)$request->quantity/count($areaCodes));

    	}
    	//Buscar si ya existen los numeros en la base de datos
    	$this->validateNumberBD($areaCodes,$numbers);
    	return view('prueba')
    			->with('areaCodes',$areaCodes)
    			->with('numbers',$numbers);
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

    	$queryZone = array();
    	foreach ($zonas as $key => $value) {
    		$queryZone[] = $key;
     	}
     	
    	
    	$areaCodes = AreaCode::join('STATESZONE', function($join) use ($queryStates,$queryZone){
    				$join->on('AREACODES.STATESZONE_ID','=','STATESZONE.STATESZONE_ID')
    				->whereIn('ZONES_ID',$queryZone)
    				->whereIn('STATES_ID',$queryStates);
    			})->get(['AREACODES.CODE','AREACODES.AREACODES_ID']);
    	//\Debugbar::info($areaCodes);
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
		$arrayAreaCodes = array();
		foreach ($areaCodes as $key => $value) {
			$arrayAreaCodes[] = $value->AREACODES_ID;
		}

		$consultArray = array();
		
		for($i = 0; $i < count($numbers); $i++){
			for($j = 0; $j < count($arrayAreaCodes);$j++){

				$consultArray[] = (['PHONE' => $numbers[$i],'AREACODES_ID' => $arrayAreaCodes[$j]]);
				

			}
			
		}
		dd($consultArray);
		

		$searchOrCreate = Phone::firstOrCreate($consultArray);
		dd($searchOrCreate);


		
	}

}
