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

Route::get('/', function () {
    return view('index');
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('send', 'MailController@send');
Route::get('/verifyEmail', 'Auth\RegisterController@verifyEmail')->name('verifyEmail');
Route::get('verify/{token}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');
Route::get('/follow/{friend_id}', 'FollowUnfollow@followFriend');
Route::get('/unfollow/{friend_id}', 'FollowUnfollow@unfollowFriend');
Route::get('/profile', 'UserController@show_profile_view')->name('profile')->middleware('auth');
Route::put('/profile/update', 'UserController@update')->name('update_profile')->middleware('auth');
Route::resource('/post', 'PostController');
Route::resource('/adventure', 'AdventureController');
Route::get('/post/image/{post_id}', 'PostController@getImagePost');
Route::get('/like/{post_id}', 'PostController@like')->name('like');
Route::get('/search', 'SearchController@search');
Route::get('/search/unfollowedFriend', 'SearchController@searchFriendNotFollowed');
Route::get('/search/followedFriend', 'SearchController@searchFriendFollowed');
Route::get('/search/adventure', 'SearchController@searchAdventure');
Route::get('/post/like/{post_id}/count', 'PostController@whoLikeThisPost');