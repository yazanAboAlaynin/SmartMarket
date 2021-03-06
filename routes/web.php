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
    Route::get('/vendor', 'vendor\VendorController@index')->name('vendor');

/****** user ********/

    Route::get('/products', 'UserController@products')->name('products');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
    Route::post('/profile/update', 'UserController@update')->name('profile.update');
    Route::get('/products/{type}/{choice}', 'UserController@search')->name('search');
    Route::post('/products/search', 'UserController@searchBtn')->name('searchBtn');
    Route::get('/show/products', 'UserController@showProducts')->name('showProducts');
    Route::get('/view/product/{product}', 'UserController@viewProduct')->name('viewProduct');
    Route::get('/add/product/{product}', 'UserController@addToCart')->name('addProduct');
    Route::get('/delete/product/{product}', 'UserController@deleteFromCart')->name('deleteProduct');
    Route::get('/cart', 'UserController@cart')->name('cart');
    Route::get('/order', 'UserController@order')->name('order');
    //Route::get('/search', 'UserController@search')->name('search');
    Route::get('/add/review/{product}', 'UserController@addReview')->name('add.review');
    Route::get('/review', 'UserController@review')->name('review');
    //Route::get('/prop/{product}', 'UserController@otherProperties')->name('otherProperties');

    Route::get('/add/order/review/{order}', 'UserController@addOrderReview')->name('add.orderReview');
    Route::get('/recommendation', 'UserController@recommendation')->name('recommendation');

/*******************************************************************************************************/

Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/register', 'auth\RegisterController@index')->name('register');

    Route::post('/train1', 'AdminController@train1')->name('train1');
    Route::post('/train2', 'AdminController@train2')->name('train2');
    Route::get('/training', 'AdminController@training')->name('training');

    Route::post('/create', 'auth\RegisterController@register')->name('create');

    Route::get('/addAdmin', 'AdminController@addnewAdmin')->name('addAdmin')->middleware('moderator');
    Route::post('/create', 'AdminController@addAdmin')->name('create')->middleware('moderator');
    Route::get('/admins', 'AdminController@admins')->name('admins')->middleware('moderator');
    Route::get('/admin/delete', 'AdminController@deleteAdmin')->name('admin.delete')->middleware('moderator');;

    Route::get('/home', 'AdminController@index')->name('home');
    Route::get('/users/count', 'AdminController@usersCount')->name('users.count');
    Route::get('/vendors/count', 'AdminController@vendorsCount')->name('vendors.count');
    Route::get('/vendors/req/count', 'AdminController@vendorsReqCount')->name('vendors.req.count');
    Route::get('/orders/count', 'AdminController@ordersCount')->name('orders.count');

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
    Route::post('/order/read', 'AdminController@readOrder')->name('read.order');

    Route::get('/products', 'AdminController@products')->name('products');
    Route::get('/product/{product}/update', 'AdminController@updateProduct')->name('product.update')->middleware('moderator');
    Route::post('/product/{product}/edit', 'AdminController@editProduct')->name('product.edit')->middleware('moderator');
    Route::get('/product/delete', 'AdminController@deleteProduct')->name('product.delete')->middleware('moderator');

    Route::get('/category/add', 'AdminController@addCategory')->name('category.add');
    Route::post('/category/store', 'AdminController@storeCategory')->name('category.store');
    Route::get('/categories', 'AdminController@categories')->name('categories');
    Route::get('/category/{category}/update', 'AdminController@updateCategory')->name('category.update');
    Route::post('/category/{category}/edit', 'AdminController@editCategory')->name('category.edit');
    Route::get('/category/delete', 'AdminController@deleteCategory')->name('category.delete');

    Route::get('/brand/add', 'AdminController@addBrand')->name('brand.add');
    Route::post('/brand/store', 'AdminController@storeBrand')->name('brand.store');
    Route::get('/brands', 'AdminController@brands')->name('brands');
    Route::get('/brand/{brand}/update', 'AdminController@updateBrand')->name('brand.update');
    Route::post('/brand/{brand}/edit', 'AdminController@editBrand')->name('brand.edit');
    Route::get('/brand/delete', 'AdminController@deleteBrand')->name('brand.delete');


});

/****************************************************************************************************************/

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
    Route::get('/product', 'VendorController@product')->name('product');
    Route::get('/product/delete', 'VendorController@deleteProduct')->name('product.delete');

    Route::get('/product/{product}/add/Properties', 'VendorController@addProperties')->name('product.add.properties');
    Route::post('/product/{product}/store/Properties', 'VendorController@storeProperties')->name('product.store.properties');


    Route::get('/discounts', 'VendorController@discounts')->name('discounts');
    Route::get('/discount/{discount}/update', 'VendorController@updateDiscount')->name('discount.update');
    Route::post('/discount/{discount}/edit', 'VendorController@editDiscount')->name('discount.edit');
    Route::get('/discount/delete', 'VendorController@deleteDiscount')->name('discount.delete');

    Route::get('/orders', 'VendorController@orders')->name('orders');
    Route::get('/sold/items', 'VendorController@soldItems')->name('soldItems');
   // Route::get('/dashboard', 'VendorController@dashboard')->name('dashboard');

});
