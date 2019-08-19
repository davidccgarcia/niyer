<?php

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

Route::get('products', 'ProductController@index')
    ->name('products');
Route::get('products/create', 'ProductController@create')
    ->name('products.create');
Route::post('products', 'ProductController@store')
    ->name('products.store');

Route::get('sales', 'SaleController@index')
    ->name('sales');
Route::post('sales', 'SaleController@store')
    ->name('sales.store');
