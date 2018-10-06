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

Route::get('/', 'PlayerController@index');
Route::resource('players', 'PlayerController', ['except' => ['create', 'show']]);

Route::get('parings', function(){
  return view('parings.index');
})->name('parings');



Route::resource('rounds', 'RoundController', ['exclude' => 'edit']);

// Route::get('rounds', 'RoundController@index')->name('rounds.index');
// Route::post('rounds', 'RoundController@store')->name('rounds.store');
// Route::delete('rounds/{id}', 'RoundController@destroy')->name('rounds.destroy');
// Route::get('rounds/{id}', 'RoundController@show')->name('rounds.destroy');

Route::get('parings_api/parings/drawAll', 'ParingController@drawAll');
Route::get('parings_api/parings/draw', 'ParingController@draw');
Route::get('parings_api/parings/pause', 'ParingController@getPausingPlayer');
Route::get('parings_api/parings/{id}', 'ParingController@show');
Route::get('parings_api/parings', 'ParingController@index');
Route::post('parings_api/parings', 'ParingController@store');

Route::get('parings_api/rounds/{id}', 'RoundController@getParingsByRound');

Route::get('campagin/create', 'CampaginController@createCampagin')->name('campagin.create');
