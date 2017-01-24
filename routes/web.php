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


Route::group(['prefix' => 'verify'], function () {
    Route::get('/{token}', ['uses' => 'VerifyFrontEndController@verify', 'as' => 'api.get.verify.token']);
    Route::get('/', ['uses' => 'VerifyFrontEndController@verify', 'as' => 'api.get.verify']);
    Route::post('/', ['uses' => 'VerifyFrontEndController@verify', 'as' => 'api.send.verify.token']);
});
