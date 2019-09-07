<?php

namespace App\Http\Controllers\Vicidial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VicidialModel\VicidialList;
class VicidialPruebaController extends Controller
{
    public function index(){
    	$list = VicidialList::find(1);
    	dd($list);
    }
}
