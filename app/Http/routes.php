<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'homepage@index');

//Route::get('home', 'HomeController@index');


Route::get('/', 'pages\homepage@getIndex');
Route::controller('/pages', 'pages\homepage');
Route::controller('/membership', 'pages\membership');
Route::controller('/expense', 'pages\expense');

