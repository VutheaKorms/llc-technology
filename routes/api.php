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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users','UsersController');
    Route::put('users/update/{id}','UsersController@updateUser');
    Route::put('user/disable/{id}','UsersController@disable');
    Route::put('user/enable/{id}','UsersController@enable');
    Route::get('/test', function() {
        return Auth::user();
    });
});

//Route::resource('brands','BrandsController');
Route::get('brands/account/{id}','BrandsController@index');
Route::post('brands/post','BrandsController@store');
Route::get('brands/edit/{id}','BrandsController@edit');
Route::get('brands/{id}','BrandsController@show');
Route::delete('brands/{id}','BrandsController@destroy');
Route::put('brands/{brand}','BrandsController@update');
Route::put('brands/disable/{id}','BrandsController@disable');
Route::get('brands/status/{status}/acc/{id}','BrandsController@getAllActive');
Route::get('brands/status/{status}','ItemController@getAllBrandActive');

//Route::resource('categories','CategoriesController');
Route::get('categories/account/{id}','CategoriesController@index');
Route::get('categories/edit/{id}','CategoriesController@edit');
Route::get('categories/{id}','CategoriesController@show');
Route::post('categories/post','CategoriesController@store');
Route::put('categories/{category}','CategoriesController@update');
Route::delete('categories/{id}','CategoriesController@destroy');
Route::put('categories/disable/{id}','CategoriesController@disable');
Route::get('categories/status/{status}/acc/{id}','CategoriesController@getAllActive');
Route::get('categories/status/{status}/brand/{brand}','CategoriesController@getCateByBrand');
Route::get('categories/status/{status}','ItemController@getAllActive');

Route::group(['middleware' => ['web']], function () {
    Route::get('products/account/{id}','ProductsController@index');
    Route::get('products/{id}','ProductsController@show');
    Route::get('products/{id}/edit','ProductsController@edit');
    Route::post('products','ProductsController@store');
    Route::put('products/{id}','ProductsController@update');
    Route::delete('products/{id}','ProductsController@destroy');
//    Route::resource('products','ProductsController');
    Route::put('products/disable/{id}','ProductsController@disable');
});

Route::post('test/upload','ProductsController@upload');
Route::post('test/editUpload','ProductsController@editUpload');
Route::get('product/review/{id}','ProductsController@showPhoto');
Route::get('product','ItemController@index');
Route::delete('photo/delete/{id}','ProductsController@destroyPhoto');
Route::get('photo/{id}','ProductsController@editPhoto');
Route::post('cover/upload','UploadController@upload');
Route::get('cover','UploadController@index');
Route::delete('cover/{id}','UploadController@destroyPhoto');
Route::get('cover/{id}','UploadController@editPhoto');
Route::get('productByCate/{cateId}','CategoriesController@getProductByCate');
Route::get('productByCategory/{id}','ItemController@getProByCategory');

Route::get('address','ContactsController@index');
Route::get('contacts/acc/{acc}','ContactsController@getContact');
Route::get('contacts/status/{status}/acc/{acc}','ContactsController@getAllActive');





