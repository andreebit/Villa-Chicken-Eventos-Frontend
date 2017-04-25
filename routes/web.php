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

Route::group(['prefix' => 'events'], function () {
    Route::group(['prefix' => 'packages'], function () {
        Route::get('/', ['as' => 'packages.index', 'uses' => 'PackagesController@index']);
        Route::get('/form', ['as' => 'packages.create', 'uses' => 'PackagesController@create']);
        Route::get('/form/{id}', ['as' => 'packages.edit', 'uses' => 'PackagesController@edit']);
        Route::get('/delete/{id}', ['as' => 'packages.delete', 'uses' => 'PackagesController@delete']);
    });
});
