<?php

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PhonesExport;
use App\Phone;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('login','Auth\LoginController@login');

Route::get('generate','GenerateNumbersController@index');
Route::post('generate','GenerateNumbersController@generate')->name('numberGenerate');

Route::get('generate-number-aleatorio','NumbersController@create');
Route::get('export-number',function(){
	$date = date("Y-m-d H:i:s");
	return Excel::download(new PhonesExport,'phones-'.$date.'.xlsx');
})->name('exportar');


Route::get('vicidial','Vicidial\VicidialPruebaController@index');