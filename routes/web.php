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

Route::get('/company/{company}/update', 'admin\HomeController@update')->name('company.update');
Route::get('/company/delete', 'admin\HomeController@deleteCompany')->name('company.delete');
Route::post('/company/{id}/edit', 'admin\HomeController@edit')->name('company.edit');




Route::namespace('Admin')->prefix('admin')->as('admin.')->group(function() {
    Auth::routes(['register' => false]);
    Route::get('/home', 'HomeController@index');
    Route::get('/companies', 'HomeController@companies')->name('companies');
    //Route::get('companies', ['uses'=>'HomeController@companies', 'as'=>'admin.companies']);
});

