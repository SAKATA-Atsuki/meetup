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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/home', 'User\HomeController@index')->name('home');

// auth
Auth::routes();

// top
Route::get('/', 'TopController@index')->name('top');
Route::post('/', 'TopController@search');
Route::post('/category', 'TopController@category')->name('top.category');

// circle
Route::get('circle', 'CircleController@index')->name('circle');
Route::get('circle/favorite', 'CircleController@favorite')->name('circle.favorite');
Route::get('circle/unfavorite', 'CircleController@unfavorite')->name('circle.unfavorite');
