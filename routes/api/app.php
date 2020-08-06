<?php
/**
 * Author Cjc
 * DateTime 2020/8/5 4:45 下午
 * Description:
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'app','namespace'=>'App'],function(){
    Route::group(['prefix'=>'auth','namespace'=>'Auth'],function(){
        Route::post('login','AuthController@login');
        Route::post('logout','AuthController@logout')->middleware('auth:user');
    });
    Route::group(['middleware'=>'auth:user'],function(){
        Route::apiResource('user','User\UserController');
    });
});
