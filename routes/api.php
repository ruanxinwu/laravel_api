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

Route::group(['middleware' => ['api.log']],function() {
    Route::post('login', 'Api\LoginController@login');
    Route::post('register', 'Api\LoginController@register');
});
Route::group(['middleware' => ['token','api.log']],function(){
    Route::post('loginOut','Api\LoginController@loginOut');
    Route::post('default/show','Api\DefaultController@show');
    Route::post('order/index','Api\OrderController@index');
});
