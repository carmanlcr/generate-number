<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\PhonesExport;
class ExcelController extends Controller
{	


    public function export($date1){
		return (new PhonesExport($date1))->download('phones'.date("Y-m-d H:i:s").'.xlsx', \Maatwebsite\Excel\Excel::XLSX);;
			
    }



}
