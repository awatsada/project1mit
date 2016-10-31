<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('in', function () {
    return view('project/page/inindex');
});

Route::get('fixx', function(){
    return view('project/page/fix');
});


Route::get('re', function(){
    return view('project/page/record');
});

Route::get('shr', function(){
    return view('project/page/showrepair');
});

Route::get('she', function(){
    return view('project/page/showequipment');
});

Route::get('pdf', function () {
    $pdf = PDF::loadView('pdf');
    return $pdf->stream('archivo.pdf');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('home', 'HomeController@index');
    Route::get('fix', 'HomeController@fix');
    Route::post('fixxx', 'HomeController@savefix');

    
    Route::get('show', 'HomeController@show');
    Route::get('sh/equipment/{id}', 'HomeController@showequipment');

    Route::get('sh/recordequipment/{id}', 'HomeController@record');
    // Route::get('sh/rocord/{id}', 'HomeController@record');
    Route::post('record/{id}', 'HomeController@saverecord');

    Route::post('search', 'HomeController@search');




});
