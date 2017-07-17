<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('brands','BrandsController');
//Route::put('brands/disable/{id}','BrandsController@disable');
//Route::get('brands/status/{status}','BrandsController@getAllActive');

Route::resource('categories','CategoriesController');
Route::put('categories/disable/{id}','CategoriesController@disable');
Route::get('categories/status/{status}','CategoriesController@getAllActive');

Route::group(['middleware' => ['web']], function () {
    Route::resource('products','ProductsController');
    Route::put('products/disable/{id}','ProductsController@disable');
});

Route::post('test/upload','ProductsController@upload');
Route::resource('photo','UploadController');
Route::get('product/review/{id}','ProductsController@showPhoto');
Route::get('products/getAll/{status}/cate/{cateId}','ProductsController@loadAllProductByCate');
Route::get('getImages/{proId}','UploadController@getImages');
Route::resource('images','UploadController');

