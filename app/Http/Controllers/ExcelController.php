<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel; 
use App\Exports\PhonesExport;
use Illuminate\Database\Eloquent\Collection;
class ExcelController extends Controller
{	

	

    public function export(){

    $date = date("Y-m-d H:i:s");
	return (new PhonesExport())->download('phones'.$date.'xlsx', \Maatwebsite\Excel\Excel::XLSX);;
		
    }



}
