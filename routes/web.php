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

Route::get('/auth/instagram/connect', 'Main\InstagramController@instagramConnectRoute')->name('instagramConnectRoute');
Route::get('auth/instagram/callback','Main\InstagramController@instagramCallbackRoute')->name('instagramCallbackRoute');


Route::get('/', 'Main\ShopifyController@getMainPage')->name('getMainPage');
