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

Route::prefix('items')->group(function() {
    Route::get('/show', 'ItemsController@show');
    Route::post('/create', 'ItemsController@create');
    Route::post('/update/{id}', 'ItemsController@update');
    Route::post('/destroy/{id}', 'ItemsController@destroy');
});

Route::prefix('categories')->group(function() {
    Route::get('/options', 'CategoryController@getOptionCollection');
});