<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//views
Route::get('/posts', 'App\Http\Controllers\PostController@index');
Route::get('/posts/create', 'App\Http\Controllers\PostController@createview');
Route::get('/posts/update', 'App\Http\Controllers\PostController@updateview');
//actions
Route::post('/posts', 'App\Http\Controllers\PostController@store');
Route::put('/posts/{id}', 'App\Http\Controllers\PostController@update');
Route::delete('/posts/{id}', 'App\Http\Controllers\PostController@delete');

//views
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/users/create', 'App\Http\Controllers\UserController@createview');
Route::get('/users/update', 'App\Http\Controllers\UserController@updateview');
//actions
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@delete');

//views
Route::get('/roles', 'App\Http\Controllers\RoleController@index');
Route::get('/roles/create', 'App\Http\Controllers\RoleController@createview');
Route::get('/roles/update', 'App\Http\Controllers\RoleController@updateview');
//actions
Route::post('/roles', 'App\Http\Controllers\RoleController@store');
Route::put('/roles/{id}', 'App\Http\Controllers\RoleController@update');
Route::delete('/roles/{id}', 'App\Http\Controllers\RoleController@delete');

//views
Route::get('/permissions', 'App\Http\Controllers\PermissionController@index');
Route::get('/permissions/create', 'App\Http\Controllers\PermissionController@createview');
Route::get('/permissions/update', 'App\Http\Controllers\PermissionController@updateview');
//actions
Route::post('/permissions', 'App\Http\Controllers\PermissionController@store');
Route::put('/permissions/{id}', 'App\Http\Controllers\PermissionController@update');
Route::delete('/permissions/{id}', 'App\Http\Controllers\PermissionController@delete');
