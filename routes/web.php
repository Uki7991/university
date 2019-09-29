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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/announce', 'HomeController@index2')->name('announce');

Route::get('/post/show', 'PostController@show')->name('post.show');
Route::get('/announce/show', 'PostController@show2')->name('announce.show');
