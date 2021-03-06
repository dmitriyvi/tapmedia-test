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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'Controller@index');
Route::get('/click', 'Controller@click');
Route::get('/success/{click_id}', 'Controller@success')->name('success');
Route::get('/error/{click_id}', 'Controller@error')->name('error');
