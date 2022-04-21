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

Route::get('/users', 'API\UserController@index');
Route::post('/users', 'API\UserController@store')->name('api.user.store');
Route::delete('/users/{id}', 'API\UserController@destroy');
//Get list articles
Route::get('articles', 'API\ArticleController@index');

//Get an article detail
Route::get('articles/{id}', 'API\ArticleController@show');

//Create an article
Route::post('articles', 'API\ArticleController@store');

//Update an article
Route::put('articles/{id}', 'API\ArticleController@update');

//Delete an article
Route::delete('articles/{id}', 'API\ArticleController@destroy');