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

Route::get('/', 'Index@welcome');
Route::get('book', 'RestServer@book');
Route::get('book/{id}', 'RestServer@book');
Route::put('book', 'RestServer@edit');
Route::delete('book', 'RestServer@delete');
Route::post('book', 'RestServer@search');
