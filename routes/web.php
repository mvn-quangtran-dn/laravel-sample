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
    'middleware' => ['is.admin']
],function(){

    // Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::get('users/{id}/set-role/{roleID}', 'UserController@setRole');
    Route::get('users/{id}/remove-role/{roleID}', 'UserController@removeRole');
    Route::get('countries/{id}/posts', 'CountryController@show');

    // Route::get('products/{id}', 'ProductController@show');
    // Route::get('posts/{id}', 'PostController@show');
});

// Route::resource('products', 'ProductController')->m;

//Show list  user
Route::get('users', 'UserController@index')->name('users.index')->middleware('is.admin');
//Show form create user
Route::get('users/create', 'UserController@create')->name('users.create')->can('create','App\Models\User');
//Store new user
Route::post('users', 'UserController@store')->name('users.store');
//Show user detail
Route::get('users/{user}', 'UserController@show')->name('users.show')->can('view','user');
//Show user edit page
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->can('update', 'user');
// Update user info
Route::put('users/{id}', 'UserController@update')->name('users.update');
// Delete user
Route::delete('users/{id}', 'UserController@destroy')->name('users.delete');

//List country pages
Route::get('countries', 'CountryController@index')->name('countries.index');

//show Form register an account
Route::get('/register', 'Auth\RegisterController@create')->name('accounts.show-register-form');
//Store an account
Route::post('register', 'Auth\RegisterController@store')->name('accounts.store');

//show Login page
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('accounts.login-form');
//Login
Route::post('/login', 'Auth\LoginController@login')->name('accounts.login');

//show home page
Route::get('/home', 'Auth\HomeController@index')
->name('accounts.home')->middleware(['auth', 'redirect.home']);

//Admin home page
Route::get('/admin/home', 'Auth\HomeController@indexAdmin')
->name('admin.home')->middleware(['auth', 'is.admin']);
// User home page
Route::get('user/home', 'Auth\HomeController@indexUser')
->name('user.home')->middleware(['auth']);

Route::get('test', function(){
    // return bcrypt('Password@123');
    $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', now()->format('Y-m-d'));
    $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', '2022-06-08');
    $diff=$date2->diffInDays($date1);
    return $diff;
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//show form create product
Route::get('/products/create', 'ProductController@create')->name('products.create');
//store new product
Route::post('/products', 'ProductController@store')->name('products.store');

//show list product
Route::get('/products', 'ProductController@index')->name('products.index');
//route
//add abc
