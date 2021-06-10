<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\Auth\RegisterController;
use App\Http\Controllers\api\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your api!
|
*/

Route::middleware('Auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'api', 'as' => 'api.'], function(){
        Route::group(['namespace' => 'Auth', 'as' => 'Auth.'], function(){
            Route::post('/registration',[RegisterController::class, 'index'])->name('registration');
            Route::post('/login',[LoginController::class, 'index'])->name('login');
        });
});
