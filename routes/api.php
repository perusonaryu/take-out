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

Route::patch('/userUpdate/{id}','StoreUserController@update');

Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});


Route::middleware('auth:sanctum')->get('/athenticated', function (Request $request) {
    return true;
});
// Route::post('/login','Api\AuthController@login');
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');

//storeitemのapiのルート
Route::apiResource('/StoreItems','StoreItemsController');




Route::group(['prefix' => 'storeusers'], function () {
    // Route::middleware('auth:storeuser')->post('register', 'StoreUsersAuth\RegisterController@register');
    Route::middleware('auth:storeuser')->get('/user', function (Request $request) {
        return auth()->guard('storeuser')->user();
    });
    Route::middleware('auth:storeuser')->get('/athenticated', function (Request $request) {
        return true;
    });

    
    
    Route::post('register', 'StoreUsersAuth\RegisterController@register');
    Route::post('login', 'StoreUsersAuth\LoginController@login');
    Route::post('logout', 'StoreUsersAuth\LoginController@logout');
});