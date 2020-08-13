<?php
/**
 * Author Cjc
 * DateTime 2020/8/9 12:01 下午
 * Description:
 */


use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'common'],function(){
    Route::get('sumStatistics','StatisticsController@sumStatistics');
    Route::get('categorySum','StatisticsController@categorySum');
});
