<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
//use Maatwebsite\Excel\Concerns\FromArray;
//use Maatwebsite\Excel\Concerns\FromView;
//use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Http\Controllers;
use App\Phone;

class PhonesExport implements WithHeadings, FromCollection
{	

	use Exportable;

	protected $data;

    public function __construct($data = null)
    {
    	
        $this->data = $data;
    }

     public function collection(){
        $phones = array();


        if(is_null($this->data)){
            $phone = Phone::select('PHONES.PHONE','AREACODES.CODE','STATES.NAME')
                ->join('AREACODES','AREACODES.AREACODES_ID','=','PHONES.AREACODES_ID')
                ->join('STATESZONE','STATESZONE.STATESZONE_ID','=','AREACODES.STATESZONE_ID')
                ->join('STATES','STATES.STATES_ID','=','STATESZONE.STATES_ID')
                ->whereDay('PHONES.DATE',date("i"))
                ->get();

            foreach ($phone as $key => $value) {
                $phones[$key]['PHONE'] = $value->CODE.''.$value->PHONE;
                $phones[$key]['NAME'] = $value->NAME;
            
            }
            return collect($phones);
        }else{
            $phone = Phone::select('PHONES.PHONE','AREACODES.CODE','STATES.NAME')
                ->join('AREACODES','AREACODES.AREACODES_ID','=','PHONES.AREACODES_ID')
                ->join('STATESZONE','STATESZONE.STATESZONE_ID','=','AREACODES.STATESZONE_ID')
                ->join('STATES','STATES.STATES_ID','=','STATESZONE.STATES_ID')
                ->where('PHONES.DATE',$this->data)
                ->get();
                        
            foreach ($phone as $key => $value) {
                $phones[$key]['PHONE'] = $value->CODE.''.$value->PHONE;
                $phones[$key]['NAME'] = $value->NAME;
            
            }


            return collect($phones);

        }
     	
     	
     }

    public function headings(): array{
    	return [
    		'TELEFONO',
    		'ESTADO'
    	];
    }


   

}
