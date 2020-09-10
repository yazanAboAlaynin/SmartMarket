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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('profile', 'API\UserController@profile');
    Route::get('categories', 'API\UserController@categories');
    Route::get('brands', 'API\UserController@brands');
    Route::get('sellers', 'API\UserController@sellers');
    Route::get('products/{type}/{id}', 'API\UserController@products');
    Route::get('product/{id}', 'API\UserController@getProduct');
    Route::get('product/{id}/category', 'API\UserController@getProductCategory');
    Route::get('product/{id}/brand', 'API\UserController@getProductBrand');
    Route::get('product/{id}/prop', 'API\UserController@productProperties');
    Route::get('product/{id}/other', 'API\UserController@otherProperties');
    Route::post('order', 'API\UserController@order');
    Route::post('search', 'API\UserController@search');
    Route::post('review', 'API\UserController@review');
    Route::get('my/items', 'API\UserController@myItems');
    Route::get('orderReview', 'API\UserController@orderReview');
    Route::get('recommendation', 'API\UserController@recommendation');
    Route::get('logout', 'API\UserController@logout');
});
