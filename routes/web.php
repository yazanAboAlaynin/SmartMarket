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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'admin\HomeController@index')->name('admin');


Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index');

    Route::get('/companies', 'HomeController@companies')->name('companies');
    Route::get('/company/{company}/update', 'HomeController@updateCompany')->name('company.update');
    Route::get('/company/delete', 'HomeController@deleteCompany')->name('company.delete');
    Route::get('/company/approve', 'HomeController@approve')->name('company.approve');
    Route::post('/company/{id}/edit', 'HomeController@editCompany')->name('company.edit');
    Route::get('/pending/companies', 'HomeController@pendingCompanies')->name('pendingCompanies');


    Route::get('/users', 'HomeController@users')->name('users');
    Route::get('/user/{user}/update', 'HomeController@updateUser')->name('user.update');
    Route::get('/user/delete', 'HomeController@deleteUser')->name('user.delete');
    Route::post('/user/{id}/edit', 'HomeController@editUser')->name('user.edit');

    Route::get('/orders', 'HomeController@orders')->name('orders');
    Route::get('/order/done', 'HomeController@done')->name('order.done');
    Route::get('/order/{order}/items', 'HomeController@orderItems')->name('order.items');
    Route::get('/old/orders', 'HomeController@oldOrders')->name('oldOrders');
});

Route::namespace('Company')->prefix('company')->as('company.')->group(function() {
    Auth::routes();
    Route::get('/home', 'CompanyController@index');

});