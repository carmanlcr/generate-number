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
    return view('auth.login');
});

//Route::get('prueba', 'AudioController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::post('login','Auth\LoginController@login');

Route::get('generate','GenerateNumbersController@index');
Route::post('generate','GenerateNumbersController@generate')->name('numberGenerate');

Route::get('generate-number-aleatorio','NumbersController@create');
