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
	
    return redirect('callcenter/calls');
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');




Route::prefix('callcenter')->group(function () {
	Route::get('generate','GenerateNumbersController@index')->name('generador');
	Route::post('generate','GenerateNumbersController@generate')->name('numberGenerate');
	Route::get('generador','GenerateNumbersController@generador');

	Route::get('/generador-automatico','Vicidial\VicidialPruebaController@count');
	Route::get('/vicidial/{zona}','Vicidial\VicidialPruebaController@index');


	Route::get('generate-number-aleatorio','NumbersController@create');
	Route::get('export-number/{date}','ExcelController@export')->name('exportar');

	Route::get('calls','Vicidial\CallsController@index')->name('calls');
	Route::POST('callsDate','Vicidial\CallsController@callsDate')->name('callsDate');
	Route::get('call','Vicidial\CallsController@calls');
});

Route::prefix('facebook')->group(function () {
	Route::get('postUser','Facebook\FacebookController@indexUserPost')->name('userPost');
	Route::get('post-user','Facebook\FacebookController@getUserPost');
	Route::get('blockUser','Facebook\FacebookController@indexUserBlock')->name('userBlock');
	Route::get('block-user','Facebook\FacebookController@getUserBlock');
	Route::prefix('users')->group(function () {
		Route::get('/','Facebook\FacebookController@users')->name('users');
		Route::get('/edit/{id}','Facebook\FacebookController@edit')->name('editFacebookUser');
		Route::POST('/update/{id}','Facebook\FacebookController@update')->name('updateFacebookUser');
	});
});

Route::prefix('task')->group(function(){
	Route::get('/','DB_ADMIN\TaskController@index')->name('taskIndex');
	Route::post('create','DB_ADMIN\TaskController@store')->name('createTask');
});

Route::prefix('instagram')->group(function () {
	Route::prefix('users')->group(function () {
		Route::get('/','Instagram\InstagramController@users')->name('usersInstagram');
		Route::get('/edit/{id}','Instagram\InstagramController@edit')->name('editInstagramUser');
		Route::POST('/update/{id}','Instagram\InstagramController@update')->name('updateInstagramUser');
	});
});

Route::prefix('twitter')->group(function () {
	Route::prefix('users')->group(function () {
		Route::get('/','Twitter\TwitterController@users')->name('usersTwitter');
		Route::get('/edit/{id}','Twitter\TwitterController@edit')->name('editTwitterUser');
		Route::POST('/update/{id}','Twitter\TwitterController@update')->name('updateTwitterUser');
	});
});

Route::prefix('profile')->group(function(){
	Route::get('/','ProfileController@index')->name('profileIndex');
	Route::get('/add','ProfileController@create')->name('profileAdd');
	Route::POST('/create','ProfileController@store')->name('profileCreate');
	Route::get('/edit/{id}','ProfileController@edit')->name('profileEdit');
	Route::POST('/update/{id}','ProfileController@update')->name('profileUpdate');
});
