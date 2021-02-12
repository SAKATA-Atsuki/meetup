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
Route::post('freshman/mypage/profile/update', 'Freshman\Mypage\ProfileController@update')->name('freshman.mypage.profile.update')->middleware(FreshmanMypage::class);

// freshman.mypage.email
Route::get('freshman/mypage/email', 'Freshman\Mypage\EmailController@index')->name('freshman.mypage.email')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/email/send', 'Freshman\Mypage\EmailController@send')->name('freshman.mypage.email.send')->middleware(FreshmanMypage::class);
Route::get('freshman/mypage/email/auth', 'Freshman\Mypage\EmailController@auth')->name('freshman.mypage.email.auth')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/email/update', 'Freshman\Mypage\EmailController@update')->name('freshman.mypage.email.update')->middleware(FreshmanMypage::class);

// freshman.mypage.password
Route::get('freshman/mypage/password', 'Freshman\Mypage\PasswordController@index')->name('freshman.mypage.password')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/password/update', 'Freshman\Mypage\PasswordController@update')->name('freshman.mypage.password.update')->middleware(FreshmanMypage::class);

// freshman.mypage.withdrawal
Route::get('freshman/mypage/withdrawal', 'Freshman\Mypage\WithdrawalController@index')->name('freshman.mypage.withdrawal')->middleware(FreshmanMypage::class);
Route::post('freshman/mypage/withdrawal/delete', 'Freshman\Mypage\WithdrawalController@delete')->name('freshman.mypage.withdrawal.delete')->middleware(FreshmanMypage::class);

// circle.mypage
use App\Http\Middleware\CircleMypage;

Route::get('circle/mypage', 'Circle\Mypage\MypageController@index')->name('circle.mypage')->middleware(CircleMypage::class);

// circle.mypage.profile
Route::get('circle/mypage/profile', 'Circle\Mypage\ProfileController@index')->name('circle.mypage.profile')->middleware(CircleMypage::class);
Route::post('circle/mypage/profile/category', 'Circle\Mypage\ProfileController@category')->name('circle.mypage.profile.category')->middleware(CircleMypage::class);
Route::post('circle/mypage/profile/check', 'Circle\Mypage\ProfileController@check')->name('circle.mypage.profile.check')->middleware(CircleMypage::class);
Route::post('circle/mypage/profile/update', 'Circle\Mypage\ProfileController@update')->name('circle.mypage.profile.update')->middleware(CircleMypage::class);

// circle.mypage.email
Route::get('circle/mypage/email', 'Circle\Mypage\EmailController@index')->name('circle.mypage.email')->middleware(CircleMypage::class);
Route::post('circle/mypage/email/send', 'Circle\Mypage\EmailController@send')->name('circle.mypage.email.send')->middleware(CircleMypage::class);
Route::get('circle/mypage/email/auth', 'Circle\Mypage\EmailController@auth')->name('circle.mypage.email.auth')->middleware(CircleMypage::class);
Route::post('circle/mypage/email/update', 'Circle\Mypage\EmailController@update')->name('circle.mypage.email.update')->middleware(CircleMypage::class);

// circle.mypage.password
Route::get('circle/mypage/password', 'Circle\Mypage\PasswordController@index')->name('circle.mypage.password')->middleware(CircleMypage::class);
Route::post('circle/mypage/password/update', 'Circle\Mypage\PasswordController@update')->name('circle.mypage.password.update')->middleware(CircleMypage::class);

// circle.mypage.withdrawal
Route::get('circle/mypage/withdrawal', 'Circle\Mypage\WithdrawalController@index')->name('circle.mypage.withdrawal')->middleware(CircleMypage::class);
Route::post('circle/mypage/withdrawal/delete', 'Circle\Mypage\WithdrawalController@delete')->name('circle.mypage.withdrawal.delete')->middleware(CircleMypage::class);

// admin
Route::get('admin', 'Admin\HomeController@index')->name('admin');

// admin.campus
Route::get('admin/campus', 'Admin\CampusController@index')->name('admin.campus')->middleware('auth:admin');
Route::post('admin/campus', 'Admin\CampusController@search')->middleware('auth:admin');
Route::get('admin/campus/register', 'Admin\CampusController@register')->name('admin.campus.register')->middleware('auth:admin');
Route::post('admin/campus/register/check', 'Admin\CampusController@checkRegister')->name('admin.campus.register.check')->middleware('auth:admin');
Route::post('admin/campus/register/store', 'Admin\CampusController@store')->name('admin.campus.register.store')->middleware('auth:admin');
Route::get('admin/campus/detail', 'Admin\CampusController@detail')->name('admin.campus.detail')->middleware('auth:admin');
Route::get('admin/campus/edit', 'Admin\CampusController@edit')->name('admin.campus.edit')->middleware('auth:admin');
Route::post('admin/campus/edit/check', 'Admin\CampusController@checkEdit')->name('admin.campus.edit.check')->middleware('auth:admin');
Route::post('admin/campus/edit/update', 'Admin\CampusController@update')->name('admin.campus.edit.update')->middleware('auth:admin');
Route::get('admin/campus/delete', 'Admin\CampusController@getDelete')->name('admin.campus.delete')->middleware('auth:admin');
Route::post('admin/campus/delete', 'Admin\CampusController@postDelete')->middleware('auth:admin');
