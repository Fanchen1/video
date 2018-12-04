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

#主域名
Route::domain('www.video.com')->group(function () {
    Route::get('/', function () {
        return view('Home/Index.Index');
    });
});

# api 接口
Route::domain('api.video.com')->group(function () {
    Route::get('/', function () {
        return 'API';
    });
});




