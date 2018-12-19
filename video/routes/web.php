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
    //首页
    Route::get('/', 'Home\IndexController@Index' );
    //播放详情
    Route::match(['get','post'] ,'playDetails' , 'Home\IndexController@playDetails');
    //视频播放
    Route::match(['get','post'] ,'play' , 'Home\IndexController@Play');
    //更多列表
    Route::match(['get','post'] ,'moreMovie' , 'Home\IndexController@moreMovie');
    Route::match(['get','post'] ,'moreTeleplay' , 'Home\IndexController@moreTeleplay');
    Route::match(['get','post'] ,'moreComic' , 'Home\IndexController@moreComic');

    //尝鲜
    Route::match(['get','post'] ,'fresh' , 'Home\IndexController@fresh');
    //搜索展示
    Route::match(['get','post'] ,'soList' , 'Home\IndexController@soList');

});

######################################### 后台
Route::domain('admin.video.com')->group(function () {
//后台登录视图
Route::match(['get','post'] ,'AdminLogin','Admin\LoginController@Login');
Route::group(['middleware'=>'islogin'],function(){
    //后台首页
    Route::get('/','Admin\IndexController@Index');//后台首页
    //电影添加
    Route::match(['get','post'] ,'dyAdd', 'Admin\TvController@dyAdd');//电影--添加
    Route::match(['get','post'] ,'dyAddDo', 'Admin\TvController@dyAddDo');//电影--手动添加
    Route::match(['get','post'] ,'caidy', 'Admin\TvController@caidy');//电影--采集添加
    //电视剧添加
    Route::match(['get','post'] ,'teleplayAdd', 'Admin\TeleplayController@teleplayAdd');//电视剧--添加
    Route::match(['get','post'] ,'teleplayAddDo', 'Admin\TeleplayController@teleplayAddDo');//电视剧--执行添加
    Route::match(['get','post'] ,'caidsj', 'Admin\TeleplayController@caiDsj');//电视剧--采集添加
    //动漫添加
    Route::match(['get','post'] ,'comicAdd', 'Admin\ComicController@comicAdd');//动漫-添加
    Route::match(['get','post'] ,'comicAddDo', 'Admin\ComicController@comicAddDo');//动漫--添加
    Route::match(['get','post'] ,'caiComic', 'Admin\ComicController@caiComic');//动漫--采集添加


    //综艺添加





    //分类
    Route::match(['get','post'] ,'classifyAdd', 'Admin\ClassifyController@classifyAdd');
    Route::match(['get','post'] ,'classifyAddDo', 'Admin\ClassifyController@classifyAddDo');



    ############ 采集
//    Route::match(['get','post'] ,'dsjList', 'Admin\CoreController@dsjList');//电视剧--列表
//    Route::match(['get','post'] ,'dsjDetails', 'Admin\CoreController@dsjDetails');//电视剧--详情
//    Route::match(['get','post'] ,'dyDetails', 'Admin\CoreController@dyDetails');//电影--详情
//    Route::match(['get','post'] ,'zyList', 'Admin\CoreController@zyList');//综艺--列表
//    Route::match(['get','post'] ,'dmList', 'Admin\CoreController@dmList');//电影--列表
//    Route::match(['get','post'] ,'getSearch', 'Admin\CoreController@getSearch');//搜索
//    Route::match(['get','post'] ,'getCx', 'Admin\CoreController@getCx');//搜索

});








});


