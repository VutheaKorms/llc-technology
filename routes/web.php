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

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/products.html', 'ProductController@index')->name('product');
Route::get('/','IndexController@index')->name('welcome');
Route::get('/contact.html','IndexController@contact')->name('contact');
Route::get('/about.html','IndexController@about')->name('about');
Route::get('/product_detail.html/{id}', 'ItemController@detail')->name('product_details');



