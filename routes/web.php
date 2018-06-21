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
    return view('welcome');


});

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');


Route::get('/', 'MicropostsController@index');

// omit

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    //followとfollowers
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        
    });
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('favor', 'UserFavorController@store')->name('user.favor');
        Route::delete('unfavor', 'UserFavorController@destroy')->name('user.unfavor');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');
    });
    
    Route::group(['prefix' => 'microposts/{id}'], function () {
        Route::get('favorited', 'MicropostsController@favorited')->name('microposts.favorited');
    
    });
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});
