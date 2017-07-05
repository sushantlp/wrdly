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
   // return View::make('index');
   return view('index');
});

Route::group(['prefix' => 'api/v1'],function() {
    Route::group(['prefix' => '/user'],function() {

        // Without Jwt Token Api
        Route::post('/signup',[/*'middleware' => 'cors',*/'uses' => 'IdentifyController@signup']);
        Route::get('/emailverifiy',[/*'middleware' => 'cors',*/'uses' => 'IdentifyController@emailVerifiy']);
        Route::post('/login',[/*'middleware' => 'cors',*/'uses' => 'IdentifyController@userLogin']);
        Route::post('/token',[/*'middleware' => 'cors',*/'uses' => 'IdentifyController@tokenRegenerate']);

        // Jwt Token Api
<<<<<<< HEAD
        Route::post('/profile',[/*'middleware' => 'cors',*/'uses' => 'HabitantController@completeProfile']);
        Route::post('/updateinfo',[/*'middleware' => 'cors',*/'uses' => 'HabitantController@updateProfile']);

        Route::get('/getstatic',[/*'middleware' => 'cors',*/'uses' => 'HabitantController@getStaticData']);
        Route::get('/getbook',[/*'middleware' => 'cors',*/'uses' => 'HabitantController@getSolarSystem']);
        Route::post('/keepbook',[/*'middleware' => 'cors',*/'uses' => 'HabitantController@keepSolarSystem']);
=======
        Route::post('/profile',['middleware' => 'cors','uses' => 'HabitantController@completeProfile']);
        Route::post('/updateinfo',['middleware' => 'cors','uses' => 'HabitantController@updateProfile']);
        Route::post('/profile/image',['middleware' => 'cors','uses' => 'HabitantController@uploadProfilePic']);

        Route::get('/getstatic',['middleware' => 'cors','uses' => 'HabitantController@getWrdlyData']);
        Route::get('/getbook',['middleware' => 'cors','uses' => 'HabitantController@getSolarSystem']);
        Route::post('/keepbook',['middleware' => 'cors','uses' => 'HabitantController@keepSolarSystem']);
        Route::post('/team',['middleware' => 'cors','uses' => 'HabitantController@keepBookNotion']);
>>>>>>> 02728548e8af15968b9dba4abfc9a6b37a21b9a5
    });
});
