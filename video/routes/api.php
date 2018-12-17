<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/', function () {
    return '欢迎使用 小白 api';
});
########################################### 前台 Api





###########################################  后台 Api
//执行登录
Route::match(['get','post'] ,'LoginApi','Api\Admin\LoginApiController@loginApi') ;
//采集 入库
Route::match(['get','post'] ,'dyList', 'Api\Admin\CoreController@dyList');//电影--列表
Route::match(['get','post'] ,'dsjList', 'Api\Admin\CoreController@dsjList');//电影--列表
//尝鲜
Route::match(['get','post'] ,'getCx', 'Api\Admin\CoreController@getCx');
