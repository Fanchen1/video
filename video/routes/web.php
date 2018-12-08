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

//Route::get('/', function () {
//    return view('welcome');
//});

########################################## 主域名
Route::domain('www.video.com')->group(function () {
//    首页
    Route::get('/', function () {
        return view('Home/Index.Index');
    });


});

########################################## api 接口
Route::domain('api.video.com')->group(function () {
    Route::get('/', function () {
        return 'API';
    });
########################################### 前台 Api





###########################################  后台 Api
    //执行登录
    Route::match(['get','post'] ,'LoginApi','Api\Admin\LoginApiController@loginApi') ;


});

######################################### 后台
Route::domain('admin.video.com')->group(function () {
    //后台登录视图
    Route::match(['get','post'] ,'AdminLogin','Admin\LoginController@Login');
    
   //后台首页
    Route::get('/', function () {
        return view('Admin/Index.Index');
    });

    ############ 采集
        Route::get('indexDsCollect', 'Admin\CoreController@indexDsCollect');//电视剧
        Route::get('dsjList', 'Admin\CoreController@dsjList');//电视剧列表
        Route::get('dyList', 'Admin\CoreController@dyList');//电影
        Route::get('zyList', 'Admin\CoreController@zyList');//综艺
        Route::get('dmList', 'Admin\CoreController@dmList');//电影
        Route::get('getSearch', 'Admin\CoreController@getSearch');//搜索
        Route::get('getCx', 'Admin\CoreController@getCx');//搜索






});


