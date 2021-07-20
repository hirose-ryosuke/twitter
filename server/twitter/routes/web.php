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
  Route::post('/create', 'LinkController@create');
  Route::post('/delete/{id}', 'LinkController@delete');
  Route::post('/edit', 'UsersController@edit');
  Route::get('/edit-page/{user_id}', 'UsersController@editPage');
  Route::post('/edit-page/{user_id}', 'UsersController@image')->name('image_route');
  
  
});