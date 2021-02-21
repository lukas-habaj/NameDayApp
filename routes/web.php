<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\NameDayController@index');
Route::get('/namedays', 'App\Http\Controllers\NameDayController@index');
Route::get('/namedays/{name}', 'App\Http\Controllers\NameDayController@show');
//Route::get('/name_search', 'App\Http\Controllers\NameDayController@nameSearch'); // for ajax version of autocomplete

