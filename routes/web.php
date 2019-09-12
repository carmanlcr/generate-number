<?php


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
	
    return redirect('/generate');
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('login','Auth\LoginController@login');

Route::get('generate','GenerateNumbersController@index')->name('generador');
Route::post('generate','GenerateNumbersController@generate')->name('numberGenerate');

Route::get('/generador-automatico','Vicidial\VicidialPruebaController@count');

Route::get('generate-number-aleatorio','NumbersController@create');
Route::get('export-number/{date}','ExcelController@export')->name('exportar');


//Route::get('vicidial','Vicidial\VicidialPruebaController@index');