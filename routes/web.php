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
use App\Http\Middleware\Login;

Route::get('/', 'TopController@index')->name('top');
Route::post('/', 'TopController@search')->middleware(Login::class);
Route::post('/category', 'TopController@category')->name('top.category')->middleware(Login::class);

// circle
use App\Http\Middleware\FreshmanLogin;

Route::get('circle', 'Circle\CircleController@index')->name('circle')->middleware(Login::class);
Route::get('circle/favorite', 'Circle\CircleController@favorite')->name('circle.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/unfavorite', 'Circle\CircleController@unfavorite')->name('circle.unfavorite')->middleware(FreshmanLogin::class);

// circle.thread
use App\Http\Middleware\CreateThreadAndMessage;
use App\Http\Middleware\DeleteThreadAndMessage;

Route::get('circle/thread', 'Circle\Thread\ThreadController@index')->name('circle.thread')->middleware(Login::class);
Route::post('circle/thread', 'Circle\Thread\ThreadController@search')->middleware(Login::class);
Route::get('circle/thread/favorite', 'Circle\Thread\ThreadController@threadFavorite')->name('circle.thread.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/unfavorite', 'Circle\Thread\ThreadController@threadUnfavorite')->name('circle.thread.unfavorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/register', 'Circle\Thread\ThreadController@register')->name('circle.thread.register')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/register/favorite', 'Circle\Thread\ThreadController@registerFavorite')->name('circle.thread.register.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/register/unfavorite', 'Circle\Thread\ThreadController@registerUnfavorite')->name('circle.thread.register.unfavorite')->middleware(FreshmanLogin::class);
Route::post('circle/thread/register/store', 'Circle\Thread\ThreadController@store')->name('circle.thread.register.store')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/delete', 'Circle\Thread\ThreadController@getDelete')->name('circle.thread.delete')->middleware(DeleteThreadAndMessage::class);
Route::post('circle/thread/delete', 'Circle\Thread\ThreadController@postDelete');
Route::get('circle/thread/freshman', 'Circle\Thread\ThreadController@freshman')->name('circle.thread.freshman')->middleware(Login::class);

// circle.thread.message
Route::get('circle/thread/message', 'Circle\Thread\MessageController@index')->name('circle.thread.message')->middleware(Login::class);
Route::get('circle/thread/message/favorite', 'Circle\Thread\MessageController@favorite')->name('circle.thread.message.favorite')->middleware(FreshmanLogin::class);
Route::get('circle/thread/message/unfavorite', 'Circle\Thread\MessageController@unfavorite')->name('circle.thread.message.unfavorite')->middleware(FreshmanLogin::class);
Route::post('circle/thread/message/store', 'Circle\Thread\MessageController@store')->name('circle.thread.message.store')->middleware(CreateThreadAndMessage::class);
Route::get('circle/thread/message/delete', 'Circle\Thread\MessageController@getDelete')->name('circle.thread.message.delete')->middleware(DeleteThreadAndMessage::class);
Route::post('circle/thread/message/delete', 'Circle\Thread\MessageController@postDelete');
Route::get('circle/thread/message/freshman', 'Circle\Thread\MessageController@freshman')->name('circle.thread.message.freshman')->middleware(Login::class);

// freshman.mypage
Route::get('freshman/mypage', 'Freshman\Mypage\MypageController@index')->name('freshman.mypage')->middleware(FreshmanLogin::class);

// freshman.mypage.favorite
Route::get('freshman/mypage/favorite', 'Freshman\Mypage\FavoriteController@index')->name('freshman.mypage.favorite')->middleware(FreshmanLogin::class);
Route::get('freshman/mypage/favorite/circle', 'Freshman\Mypage\FavoriteController@circle')->name('freshman.mypage.favorite.circle')->middleware(FreshmanLogin::class);
Route::get('freshman/mypage/favorite/circle/favorite', 'Freshman\Mypage\FavoriteController@favorite')->name('freshman.mypage.favorite.circle.favorite')->middleware(FreshmanLogin::class);
Route::get('freshman/mypage/favorite/circle/unfavorite', 'Freshman\Mypage\FavoriteController@unfavorite')->name('freshman.mypage.favorite.circle.unfavorite')->middleware(FreshmanLogin::class);

// freshman.mypage.profile
Route::get('freshman/mypage/profile', 'Freshman\Mypage\ProfileController@index')->name('freshman.mypage.profile')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/profile/check', 'Freshman\Mypage\ProfileController@check')->name('freshman.mypage.profile.check')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/profile/update', 'Freshman\Mypage\ProfileController@update')->name('freshman.mypage.profile.update')->middleware(FreshmanLogin::class);

// freshman.mypage.email
Route::get('freshman/mypage/email', 'Freshman\Mypage\EmailController@index')->name('freshman.mypage.email')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/email/send', 'Freshman\Mypage\EmailController@send')->name('freshman.mypage.email.send')->middleware(FreshmanLogin::class);
Route::get('freshman/mypage/email/auth', 'Freshman\Mypage\EmailController@auth')->name('freshman.mypage.email.auth')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/email/update', 'Freshman\Mypage\EmailController@update')->name('freshman.mypage.email.update')->middleware(FreshmanLogin::class);

// freshman.mypage.password
Route::get('freshman/mypage/password', 'Freshman\Mypage\PasswordController@index')->name('freshman.mypage.password')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/password/update', 'Freshman\Mypage\PasswordController@update')->name('freshman.mypage.password.update')->middleware(FreshmanLogin::class);

// freshman.mypage.withdrawal
Route::get('freshman/mypage/withdrawal', 'Freshman\Mypage\WithdrawalController@index')->name('freshman.mypage.withdrawal')->middleware(FreshmanLogin::class);
Route::post('freshman/mypage/withdrawal/delete', 'Freshman\Mypage\WithdrawalController@delete')->name('freshman.mypage.withdrawal.delete')->middleware(FreshmanLogin::class);

// circle.mypage
use App\Http\Middleware\CircleLogin;

Route::get('circle/mypage', 'Circle\Mypage\MypageController@index')->name('circle.mypage')->middleware(CircleLogin::class);

// circle.mypage.profile
Route::get('circle/mypage/profile', 'Circle\Mypage\ProfileController@index')->name('circle.mypage.profile')->middleware(CircleLogin::class);
Route::post('circle/mypage/profile/category', 'Circle\Mypage\ProfileController@category')->name('circle.mypage.profile.category')->middleware(CircleLogin::class);
Route::post('circle/mypage/profile/check', 'Circle\Mypage\ProfileController@check')->name('circle.mypage.profile.check')->middleware(CircleLogin::class);
Route::post('circle/mypage/profile/update', 'Circle\Mypage\ProfileController@update')->name('circle.mypage.profile.update')->middleware(CircleLogin::class);

// circle.mypage.email
Route::get('circle/mypage/email', 'Circle\Mypage\EmailController@index')->name('circle.mypage.email')->middleware(CircleLogin::class);
Route::post('circle/mypage/email/send', 'Circle\Mypage\EmailController@send')->name('circle.mypage.email.send')->middleware(CircleLogin::class);
Route::get('circle/mypage/email/auth', 'Circle\Mypage\EmailController@auth')->name('circle.mypage.email.auth')->middleware(CircleLogin::class);
Route::post('circle/mypage/email/update', 'Circle\Mypage\EmailController@update')->name('circle.mypage.email.update')->middleware(CircleLogin::class);

// circle.mypage.password
Route::get('circle/mypage/password', 'Circle\Mypage\PasswordController@index')->name('circle.mypage.password')->middleware(CircleLogin::class);
Route::post('circle/mypage/password/update', 'Circle\Mypage\PasswordController@update')->name('circle.mypage.password.update')->middleware(CircleLogin::class);

// circle.mypage.notification
Route::get('circle/mypage/notification', 'Circle\Mypage\NotificationController@index')->name('circle.mypage.notification')->middleware(CircleLogin::class);
Route::get('circle/mypage/notification/reject', 'Circle\Mypage\NotificationController@reject')->name('circle.mypage.reject')->middleware(CircleLogin::class);
Route::get('circle/mypage/notification/permit', 'Circle\Mypage\NotificationController@permit')->name('circle.mypage.permit')->middleware(CircleLogin::class);

// circle.mypage.withdrawal
Route::get('circle/mypage/withdrawal', 'Circle\Mypage\WithdrawalController@index')->name('circle.mypage.withdrawal')->middleware(CircleLogin::class);
Route::post('circle/mypage/withdrawal/delete', 'Circle\Mypage\WithdrawalController@delete')->name('circle.mypage.withdrawal.delete')->middleware(CircleLogin::class);

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

// admin.subcategory
Route::get('admin/subcategory', 'Admin\SubcategoryController@index')->name('admin.subcategory')->middleware('auth:admin');
Route::post('admin/subcategory', 'Admin\SubcategoryController@search')->middleware('auth:admin');
Route::get('admin/subcategory/register', 'Admin\SubcategoryController@register')->name('admin.subcategory.register')->middleware('auth:admin');
Route::post('admin/subcategory/register/check', 'Admin\SubcategoryController@checkRegister')->name('admin.subcategory.register.check')->middleware('auth:admin');
Route::post('admin/subcategory/register/store', 'Admin\SubcategoryController@store')->name('admin.subcategory.register.store')->middleware('auth:admin');
Route::get('admin/subcategory/detail', 'Admin\SubcategoryController@detail')->name('admin.subcategory.detail')->middleware('auth:admin');
Route::get('admin/subcategory/edit', 'Admin\SubcategoryController@edit')->name('admin.subcategory.edit')->middleware('auth:admin');
Route::post('admin/subcategory/edit/check', 'Admin\SubcategoryController@checkEdit')->name('admin.subcategory.edit.check')->middleware('auth:admin');
Route::post('admin/subcategory/edit/update', 'Admin\SubcategoryController@update')->name('admin.subcategory.edit.update')->middleware('auth:admin');
Route::get('admin/subcategory/delete', 'Admin\SubcategoryController@getDelete')->name('admin.subcategory.delete')->middleware('auth:admin');
Route::post('admin/subcategory/delete', 'Admin\SubcategoryController@postDelete')->middleware('auth:admin');

// admin.freshman
Route::get('admin/freshman', 'Admin\FreshmanController@index')->name('admin.freshman')->middleware('auth:admin');
Route::post('admin/freshman', 'Admin\FreshmanController@search')->middleware('auth:admin');
Route::get('admin/freshman/register', 'Admin\FreshmanController@register')->name('admin.freshman.register')->middleware('auth:admin');
Route::post('admin/freshman/register/check', 'Admin\FreshmanController@checkRegister')->name('admin.freshman.register.check')->middleware('auth:admin');
Route::post('admin/freshman/register/store', 'Admin\FreshmanController@store')->name('admin.freshman.register.store')->middleware('auth:admin');
Route::get('admin/freshman/detail', 'Admin\FreshmanController@detail')->name('admin.freshman.detail')->middleware('auth:admin');
Route::get('admin/freshman/edit', 'Admin\FreshmanController@edit')->name('admin.freshman.edit')->middleware('auth:admin');
Route::post('admin/freshman/edit/check', 'Admin\FreshmanController@checkEdit')->name('admin.freshman.edit.check')->middleware('auth:admin');
Route::post('admin/freshman/edit/update', 'Admin\FreshmanController@update')->name('admin.freshman.edit.update')->middleware('auth:admin');
Route::get('admin/freshman/delete', 'Admin\FreshmanController@getDelete')->name('admin.freshman.delete')->middleware('auth:admin');
Route::post('admin/freshman/delete', 'Admin\FreshmanController@postDelete')->middleware('auth:admin');

// admin.circle
Route::get('admin/circle', 'Admin\CircleController@index')->name('admin.circle')->middleware('auth:admin');
Route::post('admin/circle', 'Admin\CircleController@search')->middleware('auth:admin');
Route::post('admin/circle/category', 'Admin\CircleController@category')->name('admin.circle.category')->middleware('auth:admin');
Route::get('admin/circle/register', 'Admin\CircleController@register')->name('admin.circle.register')->middleware('auth:admin');
Route::post('admin/circle/register/check', 'Admin\CircleController@checkRegister')->name('admin.circle.register.check')->middleware('auth:admin');
Route::post('admin/circle/register/store', 'Admin\CircleController@store')->name('admin.circle.register.store')->middleware('auth:admin');
Route::get('admin/circle/detail', 'Admin\CircleController@detail')->name('admin.circle.detail')->middleware('auth:admin');
Route::get('admin/circle/edit', 'Admin\CircleController@edit')->name('admin.circle.edit')->middleware('auth:admin');
Route::post('admin/circle/edit/check', 'Admin\CircleController@checkEdit')->name('admin.circle.edit.check')->middleware('auth:admin');
Route::post('admin/circle/edit/update', 'Admin\CircleController@update')->name('admin.circle.edit.update')->middleware('auth:admin');
Route::get('admin/circle/delete', 'Admin\CircleController@getDelete')->name('admin.circle.delete')->middleware('auth:admin');
Route::post('admin/circle/delete', 'Admin\CircleController@postDelete')->middleware('auth:admin');

// admin.thread
Route::get('admin/thread', 'Admin\ThreadController@index')->name('admin.thread')->middleware('auth:admin');
Route::post('admin/thread', 'Admin\ThreadController@search')->middleware('auth:admin');
Route::get('admin/thread/detail', 'Admin\ThreadController@detail')->name('admin.thread.detail')->middleware('auth:admin');
Route::get('admin/thread/delete', 'Admin\ThreadController@getDelete')->name('admin.thread.delete')->middleware('auth:admin');
Route::post('admin/thread/delete', 'Admin\ThreadController@postDelete')->middleware('auth:admin');

// admin.message
Route::get('admin/message', 'Admin\MessageController@index')->name('admin.message')->middleware('auth:admin');
Route::post('admin/message', 'Admin\MessageController@search')->middleware('auth:admin');
Route::get('admin/message/detail', 'Admin\MessageController@detail')->name('admin.message.detail')->middleware('auth:admin');
Route::get('admin/message/delete', 'Admin\MessageController@getDelete')->name('admin.message.delete')->middleware('auth:admin');
Route::post('admin/message/delete', 'Admin\MessageController@postDelete')->middleware('auth:admin');

// admin.favorite
Route::get('admin/favorite', 'Admin\FavoriteController@index')->name('admin.favorite')->middleware('auth:admin');
Route::post('admin/favorite', 'Admin\FavoriteController@search')->middleware('auth:admin');
Route::get('admin/favorite/delete', 'Admin\FavoriteController@getDelete')->name('admin.favorite.delete')->middleware('auth:admin');
Route::post('admin/favorite/delete', 'Admin\FavoriteController@postDelete')->middleware('auth:admin');

// announce
Route::get('announce', 'AnnounceController@index');