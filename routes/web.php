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
    return view('welcome');
});
Route::get('/image','ImageconductController@index');
Route::get('/test','ImageconductController@test');
Route::get('/img','ImageconductController@getDateImage');
Route::get('/quick','ImageconductController@getQuickStyleImg');
Route::get('/visit','ImageconductController@getVisitPics');
Route::get('/think','ImageconductController@getThinkPic');
Route::get('/hope','ImageconductController@getHopePic');