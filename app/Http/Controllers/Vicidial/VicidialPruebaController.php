<?php

namespace App\Http\Controllers\Vicidial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VicidialModel\VicidialList;
use App\State;
use App\Zone;
use App\Number;
use App\AreaCode;
use App\Phone;
use App\Jobs\InsertVicidial;
class VicidialPruebaController extends Controller
{

    public function count(){

        
        if(VicidialList::where('status','=','NEW')->where('list_id','=',1000)->where('called_count','=',0)->count() < 5000){

            $prueba = new GeneradorAutomatico(1);
            $prueba->generate();
            return response()->json([
                'response' => 'Se generaron 25000 numeros para la Zona 1',
                'status' => 'success'
            ]);
        }else if(VicidialList::where('status','=','NEW')->where('list_id','=',2000)->where('called_count','=',0)->count() < 5000){
            $prueba = new GeneradorAutomatico(2);
            $prueba->generate();
            return response()->json([
                'response' => 'Se generaron 25000 numeros para la Zona 2',
                'status' => 'success'
            ]);

        }else if(VicidialList::where('status','=','NEW')->where('list_id','=',3000)->where('called_count','=',0)->count() < 5000){

            $prueba = new GeneradorAutomatico(3);
            $prueba->generate();
            return response()->json([
                'response' => 'Se generaron 25000 numeros para la Zona 3',
                'status' => 'success'
            ]);

        }else if(VicidialList::where('status','=','NEW')->where('list_id','=',4000)->where('called_count','=',0)->count() < 5000){

            $prueba = new GeneradorAutomatico(4);
            $prueba->generate();
            return response()->json([
                'response' => 'Se generaron 25000 numeros para la Zona 4',
                'status' => 'success'
            ]);

        }else{
            return response()->json([
                'response' => 'La data esta llena para todas las zonas',
                'status' => 'danger'
            ]);
        }
        
    }
}

class GeneradorAutomatico{


    //Variables
    protected $zona; 


     public function __construct($zona){
        
        $this->zona = $zona;
    }

    public function generate(){
        //Buscar los codigos de area para la zona seleccionada
        $areaCodes = $this->searchAreaCode($this->zona);
        //Buscar los numeros a seleccionar
        $numbers = $this->searchNumbers(7,(int)25000/count($areaCodes));
        //Insertar los numeros en base de datos
        $this->insertDB($areaCodes,$numbers);
    }

    /**
    *
    *
    * @version 1.0.0
    * @author Luis Morales
    * @param $zonas array
    * @return $areaCodes Collection
    */
    private function searchAreaCode($zona){        
        return AreaCode::join('STATESZONE', function($join) use ($zona){
                    $join->on('AREACODES.STATESZONE_ID','=','STATESZONE.STATESZONE_ID')
                    ->where('ZONES_ID',$zona);
                })->join('STATES','STATES.STATES_ID','=','STATESZONE.STATES_ID')
        ->get(['AREACODES.CODE','AREACODES.AREACODES_ID','STATESZONE.ZONES_ID','STATES.NAME']);          
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

    private function insertDB($areaCodes,$numbers){
        $arrayAreaCodes = array();

        foreach ($areaCodes as $key => $value) {
            $arrayAreaCodes['CODE'][] = $value->CODE;
            $arrayAreaCodes['ZONE'][] = $value->ZONES_ID;
            $arrayAreaCodes['CITY'][] = $value->NAME;
        }

        $consultArray = array();

        for($i = 0; $i < count($numbers); $i++){
            for($j = 0; $j < count($arrayAreaCodes['CODE']);$j++){
                $consultArray[] = (['phone_number' => $arrayAreaCodes['CODE'][$j].$numbers[$i], 
                                'zona' => $arrayAreaCodes['ZONE'][$j],
                                'city' => $arrayAreaCodes['CITY'][$j],
                                'user' => 'ANG']);
            }
            
        }

        //Generación de colas para la inserción en la base de datos.
        $queue = new InsertVicidial($consultArray);
        dispatch($queue);
        
    }

}
