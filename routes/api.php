<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'Api\PostController@index');
Route::get('/posts/show', 'Api\PostController@show');

Route::get('/announce', 'Api\PostController@index2');
Route::get('/announce/show', 'Api\PostController@show2');
