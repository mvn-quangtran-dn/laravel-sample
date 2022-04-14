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

// Route::get('/users', 'UserController@index');
// Route::get('/users/{user}', 'UserController@show');
// Route::get('/redirect', 'UserController@redirectRoute');


Route::group([
    // 'prefix' => 'users',
    'namespace' => 'Admin',
    'as' => 'admin.',
    // 'middleware' => ['isAdmin']
],function(){

    // Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::get('users/{id}/set-role/{roleID}', 'UserController@setRole');
    Route::get('users/{id}/remove-role/{roleID}', 'UserController@removeRole');
    Route::get('countries/{id}/posts', 'CountryController@show');

    Route::get('products/{id}', 'ProductController@show');
    Route::get('posts/{id}', 'PostController@show');
});

//Show list  user
Route::get('users', 'UserController@index')->name('users.index');
//Show form create user
Route::get('users/create', 'UserController@create')->name('users.create');
//Store new user
Route::post('users', 'UserController@store')->name('users.store');
//Show user detail
Route::get('users/{id}', 'UserController@show')->name('users.show');