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

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/admin', 'admin\AdminController@index')->name('admin');

Route::get('/product', 'UserController@product')->name('product'); 
Route::get('/products', 'UserController@products')->name('products');

Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/home', 'AdminController@index')->name('home');

    Route::get('/vendors', 'AdminController@vendors')->name('vendors');
    Route::get('/vendor/{vendor}/update', 'AdminController@updateVendor')->name('vendor.update');
    Route::get('/vendor/delete', 'AdminController@deleteVendor')->name('vendor.delete');
    Route::get('/vendor/approve', 'AdminController@approve')->name('vendor.approve');
    Route::post('/vendor/{id}/edit', 'AdminController@editVendor')->name('vendor.edit');
    Route::get('/pending/vendors', 'AdminController@pendingVendor')->name('pendingVendors');


    Route::get('/users', 'AdminController@users')->name('users');
    Route::get('/user/{user}/update', 'AdminController@updateUser')->name('user.update');
    Route::get('/user/delete', 'AdminController@deleteUser')->name('user.delete');
    Route::post('/user/{id}/edit', 'AdminController@editUser')->name('user.edit');

    Route::get('/orders', 'AdminController@orders')->name('orders');
    Route::get('/order/done', 'AdminController@done')->name('order.done');
    Route::get('/order/{order}/items', 'AdminController@orderItems')->name('order.items');
    Route::get('/old/orders', 'AdminController@oldOrders')->name('oldOrders');
});

Route::namespace('Vendor')->prefix('vendor')->as('vendor.')->group(function() {
    Auth::routes();
    Route::get('/home', 'VendorController@index')->name('home');
    Route::get('/register', 'auth\RegisterController@index')->name('register');
    Route::post('/create', 'auth\RegisterController@register')->name('create');

    Route::get('/profile', 'VendorController@profile')->name('profile');
    Route::get('/profile/edit', 'VendorController@edit')->name('profile.edit');
    Route::post('/profile/update', 'VendorController@update')->name('profile.update');

    Route::get('/add/product', 'VendorController@addProduct')->name('add.product');
    Route::post('/store/product', 'VendorController@storeProduct')->name('store.product');

    Route::get('/products', 'VendorController@products')->name('products');
    Route::get('/product/{product}/update', 'VendorController@updateProduct')->name('product.update');
    Route::post('/product/{product}/edit', 'VendorController@editProduct')->name('product.edit');
    Route::get('/product/delete', 'VendorController@deleteProduct')->name('product.delete');

    Route::get('/orders', 'VendorController@orders')->name('orders');
    Route::get('/sold/items', 'VendorController@soldItems')->name('soldItems');

});
