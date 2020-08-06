<?php

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

Route::group(['prefix'=>'backend','namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
        Route::post('login','AuthController@login');
        Route::post('logout','AuthController@logout')->middleware('auth:admin');
    });
    Route::group(['middleware'=>['auth:admin']],function(){
        Route::group(['prefix'=>'user','namespace'=>'User'],function(){
            Route::get('info','AdminController@getInfo');
            Route::put('updateRole/{user}','AdminController@updateRole');
        });
        Route::apiResource('user','User\AdminController');
        Route::apiResource('role','Role\RoleController');
        Route::get('privilege','Privilege\PrivilegeController@index');
        Route::put('updatePri/{role}','Role\RoleController@updatePri');
        Route::apiResource('category','Category\CategoryController');
        Route::apiResource('product','Product\ProductController');
        Route::get('product-unit','Product\ProductController@unitList');
        Route::get('category-list','Category\CategoryController@allList');
    });

});

Route::any('test','\App\Http\Controllers\TestController@test');
