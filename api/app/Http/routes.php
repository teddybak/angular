<?php

use App\Http\Controllers\ApiAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'cors','prefix' => 'api/v1'], function () {
    Route::post('auth_login', 'ApiAuthController@userAuth' );
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('retailer', 'RetailerController');
    Route::resource('order', 'OrderController');
    Route::resource('customer', 'CustomerController');
    Route::resource('provider', 'ProviderController');
    Route::resource('employee', 'EmployeeController');

    Route::get('order/customer/{id}','OrderController@getOrderCustomer');
    Route::get('order/status/{status}','OrderController@getOrdersStatus');
    Route::put('order/{id}', 'OrderController@update');
});
