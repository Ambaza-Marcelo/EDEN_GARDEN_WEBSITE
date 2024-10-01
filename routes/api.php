<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


 Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



	
	Route::get('ebms_api/invoices/create', 'Backend\FactureController@create')->name('ebms_api.invoices.create');
	
	Route::post('ebms_api/login', 'Backend\FactureController@login')->name('ebms_api.login');
	Route::post('ebms_api/getInvoice', 'Backend\FactureController@getInvoice')->name('ebms_api.getInvoice');
	Route::post('ebms_api/addInvoice/{invoice_number}', 'Backend\FactureController@addInvoice')->name('ebms_api.addInvoice');
	Route::post('ebms_api/checkTIN', 'Backend\FactureController@checkTIN')->name('ebms_api.checkTIN');




