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
Route::get('circle', 'Circle\CircleController@index')->name('circle');
Route::get('circle/favorite', 'Circle\CircleController@favorite')->name('circle.favorite');
Route::get('circle/unfavorite', 'Circle\CircleController@unfavorite')->name('circle.unfavorite');

// circle.thread
Route::get('circle/thread', 'Circle\CircleThreadController@index')->name('circle.thread');
Route::post('circle/thread', 'Circle\CircleThreadController@search');
Route::get('circle/thread/favorite', 'Circle\CircleThreadController@favorite')->name('circle.thread.favorite');
Route::get('circle/thread/unfavorite', 'Circle\CircleThreadController@unfavorite')->name('circle.thread.unfavorite');
Route::get('circle/thread/register', 'Circle\CircleThreadController@register')->name('circle.thread.register');
Route::get('circle/thread/register/favorite', 'Circle\CircleThreadController@registerFavorite')->name('circle.thread.register.favorite');
Route::get('circle/thread/register/unfavorite', 'Circle\CircleThreadController@registerUnfavorite')->name('circle.thread.register.unfavorite');
Route::post('circle/thread/register/store', 'Circle\CircleThreadController@store')->name('circle.thread.register.store');
Route::get('circle/thread/freshman', 'Circle\CircleThreadController@freshman')->name('circle.thread.freshman');
Route::get('circle/thread/message', 'Circle\CircleThreadController@message')->name('circle.thread.message');
Route::get('circle/thread/message/favorite', 'Circle\CircleThreadController@messageFavorite')->name('circle.thread.message.favorite');
Route::get('circle/thread/message/unfavorite', 'Circle\CircleThreadController@messageUnfavorite')->name('circle.thread.message.unfavorite');
Route::post('circle/thread/message/store', 'Circle\CircleThreadController@messageStore')->name('circle.thread.message.store');
Route::get('circle/thread/message/delete', 'Circle\CircleThreadController@delete')->name('circle.thread.message.delete');
Route::get('circle/thread/message/freshman', 'Circle\CircleThreadController@messageFreshman')->name('circle.thread.message.freshman');
