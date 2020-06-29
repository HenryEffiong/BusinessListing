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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('businesses/search', 'Api\BusinessesController@search');
Route::post('businesses/rating', 'Api\BusinessesController@rating');
Route::get('businesses/details/{business}', 'Api\BusinessesController@details');

Route::middleware('auth:api')->group( function () {
    Route::resource('categories', 'Api\CategoriesController');
});

Route::middleware('auth:api')->group( function () {
    Route::get('businesses/create', 'Api\BusinessesController@create');
    Route::post('businesses/store', 'Api\BusinessesController@store');
    Route::get('businesses', 'Api\BusinessesController@index');
    Route::post('businesses/{business}', 'Api\BusinessesController@update');
    Route::delete('businesses/{business}', 'Api\BusinessesController@destroy');
    Route::get('businesses/details', 'Api\BusinessesController@details');
    
    
});
