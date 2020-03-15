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
    return view('index');
});

Route::get('nanikiru','nanikiruController@index');
Route::post('result','nanikiruController@result');
Route::get('test','nanikiruController@test');
Route::get('home','homeController@home');
