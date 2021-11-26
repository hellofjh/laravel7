<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


//基本路由
Route::get('go', function () {
    return 'route';
});

//指定控制器
//注意大小写问题
Route::get('user/getName', 'UserController@getName');

//路由重定向
Route::redirect('/jumpPage', 'user/getName', 301);

/**
 * 可用方法：get post put patch delete options
 * 包含多个：match any
 */
Route::match(array('get', 'post'), '/testMatch', 'UserContorller@testMatch');
Route::any('/testAny', 'UserController@testAny');

//视图路由
Route::view('/testView', 'welcome');

//传参
Route::get('user/{username}', function ($username) {
    return 'hello' . $username;
});
Route::get('user/{username2?}', function ($username2 = 'joe') {
    return 'hello' . $username2;
});
Route::get('user/{username3}', function ($username3){
    return 'hello' . $username3;
})->where(['username' => '[A-z]+']);

//中间件
//中间件群组 已注册的中间件
Route::get('user/testMiddleware', 'UserController@testMiddleware')->middleware('After');
//完整类名
Route::get('user/testMiddleware2', 'UserController$testMiddleware2')->middleware(\App\Http\Middleware\After::class);


