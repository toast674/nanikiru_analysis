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
    return view('top');
});

// Route::get('nanikiru','NanikiruController@index');
// Route::post('nanikiru','NanikiruController@index');
// Route::get('result','NanikiruController@result');
// Route::post('result','NanikiruController@result');
// Route::get('description','NanikiruController@description');
// Route::get('chart','BookChartController@index');
Route::get('flash','FlashController@index');
Route::get('getFlashPaishi','FlashController@getFlashPaishi');
