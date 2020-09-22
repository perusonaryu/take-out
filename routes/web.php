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


Route::get('/storeList','StoreController@index');
Route::post('/storeCreate','StoreController@store');
Route::get('/storeEdit/{id}','StoreController@edit');
Route::patch('/storeEdit/{id}','StoreController@update');
Route::delete('/storeDelete/{id}','StoreController@destroy');


//お店編集
Route::put('/storeUserUpdate/{id}','StoreUserController@update');

Route::post('/storeImage/{id}','StoreUserController@storeImage');



Route::middleware('auth:sanctum')->get('/user', function () {
    return auth()->user();
});

//ユーザー認証
Route::middleware('auth:sanctum')->get('/athenticated', function (Request $request) {
    return true;
});
// Route::post('/login','Api\AuthController@login');
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');




//お店ユーザー認証
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


//決済コントローラー
Route::get('/user/payment', 'PaymentController@getCurrentPayment')->name('user.payment');
// Route::get('/user/payment/form', 'User\PaymentController@getPaymentForm')->name('user.payment.form');
Route::post('/user/payment/store', 'PaymentController@storePaymentInfo')->name('user.payment.store');













Route::get('/{any}', function () {
    // return view('welcome');
    return view('vue');
})->where('any', '.*');

//商品追加ページのテンプレートのルート
// Route::get('/storeItem','StoreItemManageController@index');





