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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/grab', 'HomeController@getPic');

Route::post('/temp', 'ImageController@store');

Route::get('/flow', 'FlowController@index');
Route::post('/flow/vote', 'FlowController@vote');
Route::get('/flow/new/p={page}', 'FlowController@getNew');
Route::get('/flow/hot/p={page}', 'FlowController@getHot');

Route::get('/post', 'PostController@index');
Route::post('/save', 'PostController@store');


