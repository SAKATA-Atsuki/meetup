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
use App\Http\Middleware\FreshmanLogin;

Route::get('circle', 'Circle\CircleController@index')->name('circle');
Route::get('circle/favorite', 'Circle\CircleController@favorite')->name('circle.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/unfavorite', 'Circle\CircleController@unfavorite')->name('circle.unfavorite')->middleware(FreshmanLogin::class);

// circle.thread
use App\Http\Middleware\CreateThreadAndMessage;
use App\Http\Middleware\DeleteThreadAndMessage;

Route::get('circle/thread', 'Circle\Thread\ThreadController@index')->name('circle.thread');
Route::post('circle/thread', 'Circle\Thread\ThreadController@search');
Route::get('circle/thread/favorite', 'Circle\Thread\ThreadController@threadFavorite')->name('circle.thread.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/unfavorite', 'Circle\Thread\ThreadController@threadUnfavorite')->name('circle.thread.unfavorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/register', 'Circle\Thread\ThreadController@register')->name('circle.thread.register')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/register/favorite', 'Circle\Thread\ThreadController@registerFavorite')->name('circle.thread.register.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/register/unfavorite', 'Circle\Thread\ThreadController@registerUnfavorite')->name('circle.thread.register.unfavorite')->middleware(FreshmanLogin::class);
Route::post('circle/thread/register/store', 'Circle\Thread\ThreadController@store')->name('circle.thread.register.store')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/delete', 'Circle\Thread\ThreadController@delete')->name('circle.thread.delete')->middleware(DeleteThreadAndMessage::class);
Route::get('circle/thread/freshman', 'Circle\Thread\ThreadController@freshman')->name('circle.thread.freshman');

// circle.thread.message
Route::get('circle/thread/message', 'Circle\Thread\MessageController@index')->name('circle.thread.message');
Route::get('circle/thread/message/favorite', 'Circle\Thread\MessageController@favorite')->name('circle.thread.message.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/message/unfavorite', 'Circle\Thread\MessageController@unfavorite')->name('circle.thread.message.unfavorite')->middleware(FreshmanLogin::class);
Route::post('circle/thread/message/store', 'Circle\Thread\MessageController@store')->name('circle.thread.message.store')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/message/delete', 'Circle\Thread\MessageController@delete')->name('circle.thread.message.delete')->middleware(DeleteThreadAndMessage::class);
Route::get('circle/thread/message/freshman', 'Circle\Thread\MessageController@freshman')->name('circle.thread.message.freshman');

// freshman.mypage
use App\Http\Middleware\FreshmanMypage;

Route::get('freshman/mypage', 'Freshman\Mypage\MypageController@index')->name('freshman.mypage')->middleware(FreshmanMypage::class);

// freshman.mypage.favorite
Route::get('freshman/mypage/favorite', 'Freshman\Mypage\FavoriteController@index')->name('freshman.mypage.favorite')->middleware(FreshmanMypage::class);
Route::get('freshman/mypage/favorite/circle', 'Freshman\Mypage\FavoriteController@circle')->name('freshman.mypage.favorite.circle')->middleware(FreshmanMypage::class);
Route::get('freshman/mypage/favorite/circle/favorite', 'Freshman\Mypage\FavoriteController@favorite')->name('freshman.mypage.favorite.circle.favorite')->middleware(FreshmanLogin::class);
Route::get('freshman/mypage/favorite/circle/unfavorite', 'Freshman\Mypage\FavoriteController@unfavorite')->name('freshman.mypage.favorite.circle.unfavorite')->middleware(FreshmanLogin::class);

// freshman.mypage.profile
Route::get('freshman/mypage/profile', 'Freshman\Mypage\ProfileController@index')->name('freshman.mypage.profile')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/profile/check', 'Freshman\Mypage\ProfileController@check')->name('freshman.mypage.profile.check')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/profile/store', 'Freshman\Mypage\ProfileController@store')->name('freshman.mypage.profile.store')->middleware(FreshmanMypage::class);

// freshman.mypage.email

// freshman.mypage.password

// freshman.mypage.withdrawal




// circle.mypage
use App\Http\Middleware\CircleMypage;

Route::get('circle/mypage', 'Circle\Mypage\MypageController@index')->name('circle.mypage')->middleware(CircleMypage::class);

// circle.mypage.profile

// circle.mypage.email

// circle.mypage.password

// circle.mypage.withdrawal
