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
    return View::make('index');
});

Route::group(['prefix' => 'api/v1'],function() {
    Route::group(['prefix' => '/user'],function() {
        Route::post('/signup','IdentifyController@signup');
        Route::get('/emailverifiy','IdentifyController@emailVerifiy');
        Route::post('/login','IdentifyController@userLogin');
    });
});
