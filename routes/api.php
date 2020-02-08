<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


	Route::get('task','DB_ADMIN\TaskController@indexApi');
	Route::get('getGeneres','DB_ADMIN\TaskController@getGeneresOfTheCampaing');
	Route::get('getCampaingForRrss','DB_ADMIN\TaskController@getCampaingForRrss');
	Route::get('getUsersForCategories','DB_ADMIN\TaskController@getUsersForCategories');

	Route::prefix('facebook')->group(function(){
		Route::get('users','Facebook\FacebookController@getUsers')->name('getUsersFacebook');
	});

	Route::prefix('instagram')->group(function(){
		Route::get('users','Instagram\InstagramController@getUsers')->name('getUsersInstagram');
	});

	Route::prefix('twitter')->group(function(){
		Route::get('users','Twitter\TwitterController@getUsers')->name('getUsersTwitter');
	});
	
	Route::get('users_create','ProfileController@indexApi');