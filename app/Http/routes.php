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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('in', function () {
//     return view('project/page/inindex');
// });

// Route::get('fixx', function(){
//     return view('project/page/fix');
// });

// Route::get('re', function(){
//     return view('project/page/record');
// });

// Route::get('shr', function(){
//     return view('project/page/showrepair');
// });

// Route::get('she', function(){
//     return view('project/page/showequipment');
// });

// Route::get('st', function(){
//     return view('project/page/statpdf');
// });

// Route::get('pdf', function () {
//     $pdf = PDF::loadView('pdf');
//     return $pdf->stream('archivo.pdf');
// });

// Route::get('/ppp', function (Codedge\Fpdf\Fpdf\FPDF $fpdf) {

//         $fpdf->AddPage();
//         $fpdf->AddFont('angsa','','angsa.php');
//         $fpdf->SetFont('angsa','',36);
//         $fpdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'พิมพ์ให้อยู่ตรงกลาง' ) , 0 , 1 , 'C' );
//         // $fpdf->Cell( 0  , 5 , iconv( 'UTF-8','cp874' , 'พิมพ์ให้อยู่ตรงกลาง' ) , 0 , 1 , 'C' );
//         $fpdf->Output();
//         exit;

// });


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

    // Route::get('register', 'Auth\AuthController@showRegistrationForm');
    // Route::post('register', 'Auth\AuthController@register');

Route::group(['middleware' => 'web'], function () {
    

 Route::auth();

// Route::get('/','HomeController@index');

    Route::get('home', 'HomeController@index');
    Route::get('fix', 'HomeController@fix');
    Route::post('savefix', 'HomeController@savefix');

    Route::get('member', 'HomeController@getmember');
    Route::post('member/{id}', 'HomeController@postmember');

    Route::get('fix/detail/{id}', 'HomeController@detailfix');
    Route::get('fix/detail/delete_fix/{id}', 'HomeController@delete_fix');
    Route::get('fix/detail/delete_detail/{id}', 'HomeController@delete_detail_fix');

 
    Route::get('fix/detail/edit_fix/{id}', 'HomeController@edit_fix');
    Route::post('fix/detail/update_fix/{id}', 'HomeController@update_fix');

    Route::get('fix/detail_Eq/edit_Eq/{id}', 'HomeController@editEq_fix');    
    Route::post('fix/detail_Eq/update_Eq/{id}', 'HomeController@updateEq_fix');  

/////////////////////*********************************///////////////////////   
    Route::get('showw', 'HomeController@showw');
    Route::get('sh/equipment/{id}', 'HomeController@showequipment');

/////////////////////*********************************///////////////////////
    Route::get('sh/recordequipment/{id}', 'HomeController@record');
    // Route::get('sh/rocord/{id}', 'HomeController@record');
    Route::post('record/{id}', 'SaverepairController@saverecord');

    Route::get('edit_record_complete/{id}', 'HomeController@edit_record_complete');
    Route::post('update_record_complete/{id}', 'HomeController@update_record_complete');

    Route::get('edit_record_uncomplete/{id}', 'HomeController@edit_record_uncomplete');
    Route::post('update_record_uncomplete/{id}', 'HomeController@update_record_uncomplete');
    Route::get('delete_record_uncomplete/{id}', 'HomeController@delete_record_uncomplete');


/////////////////////*********************************///////////////////////ห
    Route::post('search', 'HomeController@search');

    Route::get('getpdf/{id}', 'HomeController@getPDF');

    Route::get('stat/', 'HomeController@stat');

    Route::post('statt/', 'HomeController@statt');

    Route::post('stat/print', 'HomeController@statprint');

    Route::get('re/report/{id}', 'HomeController@rereport');

    Route::post('stat/pdf', 'HomeController@statpdf');

/////////////////////*********************************///////////////////////

    Route::get('savestock', 'StockController@showsavestock');
    Route::post('savestock', 'StockController@savestock');
    Route::get('showstock', 'StockController@showstock');

    Route::get('edit_stock/{id}', 'StockController@edit_stock');
    Route::post('update_stock/{id}', 'StockController@update_stock');

    Route::get('delete_stock/{id}', 'StockController@delete_stock');


/////////////////////*********************************///////////////////////




});
