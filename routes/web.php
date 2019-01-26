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

//Route::get('/', function () {
    //return view('auth.login');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');

route::resource('/posts', 'PostController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/refreshcaptcha', 'CaptchaController@refreshCaptcha');

route::resource('comment', 'CommentController', ['only'=>['update', 'destroy']]);

route::post('/comment/create/{post}', 'CommentController@addPostComment');

route::post('/reply/create/{comment}', 'CommentController@addReplyComment');

Route::post('post/like','LikeController@PostToggleLike')->name('PosttoggleLike');

Route::post('comment/like','LikeController@CommentToggleLike')->name('CommenttoggleLike');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile')->middleware('auth');

