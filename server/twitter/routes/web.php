<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'LinkController@index');
    Route::get('/mail', 'MailSendController@send');
    Route::post('/create', 'LinkController@create');
    Route::post('/delete/{id}', 'LinkController@delete');
    // いいねボタン
    Route::get('/edit-page', 'UsersController@editPage');
    Route::post('/edit', 'UsersController@edit');
    Route::group(['prefix' => 'edit-page/'], function () {
        Route::post('image', 'UsersController@image')->name('image_route');
        Route::post('email', 'UsersController@userEmailChange')->name('email.change');
        Route::get('userEmailUpdate/', 'UsersController@userEmailUpdate');
    });
    Route::get('/users', 'UserFollowController@index');
    Route::get('/users-follow', 'UserFollowController@following');
    Route::get('/users-follower', 'UserFollowController@follower');

    //vue

    //topPage
    //tweet-favoriteButton
    Route::get('/twitter/like/{id}', 'LinkController@like')->name('twitter.like');
    Route::get('/twitter/unlike/{id}', 'LinkController@unlike')->name('twitter.unlike');
    Route::get('/favorite', 'LinkController@favorite');

    //top-tweet
    Route::get('/getData', 'LinkController@getData');
    Route::post('/addData', 'LinkController@addData');
    Route::post('/deleteData/{id}', 'LinkController@deleteData');

    //followButton
    Route::put('/api/like/{id}', 'LinkController@like');
    Route::delete('/api/unlike/{id}', 'LinkController@unlike');

    //usersPage
    Route::get('/usersData', 'UserFollowController@usersData');

    //favoritePage
    Route::get('/favoriteData', 'LinkController@favoriteData');

    //followingPage
    Route::get('/followsData', 'UserFollowController@followsData');

    //followerPage
    Route::get('/followerData', 'UserFollowController@followerData');

    //followButton
    Route::post('/usersFollow/{id}', 'UserFollowController@follow');
    Route::delete('/usersUnFollow/{id}', 'UserFollowController@unfollow');

});