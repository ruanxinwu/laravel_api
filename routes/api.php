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

    Route::group(['middleware' => ['permission:permission_1','role:writer|io']], function () {
        Route::post('default/show','Api\DefaultController@show');
    });

    Route::post('loginOut','Api\LoginController@loginOut');
    Route::post('order/index','Api\OrderController@index');
    Route::post('permission/createRoles','Api\PermissionController@createRoles');
    Route::post('permission/createPermission','Api\PermissionController@createPermission');
});
