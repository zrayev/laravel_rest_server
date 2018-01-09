<?php

use Illuminate\Http\Request;

//Use App\Post;
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

Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });


Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function () {
    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show')->where('user', '[0-9]+');
    Route::delete('users/{user}', 'UserController@delete')
        ->where('user', '[0-9]+');

    Route::get('posts', 'PostController@index');
    Route::get('posts/{post}', 'PostController@show')->where('post', '[0-9]+');
    Route::post('posts', 'PostController@store');
    Route::put('posts/{post}', 'PostController@update')
        ->where('post', '[0-9]+');
    Route::patch('posts/{post}', 'PostController@updatePatch')
        ->where('post', '[0-9]+');
    Route::delete('posts/{post}', 'PostController@delete')
        ->where('post', '[0-9]+');

    Route::get('/users/{user}/posts', 'UserController@posts')
        ->where('user', '[0-9]+');
    Route::delete('/users/{user}/posts', 'UserController@postsDelete')
        ->where('user', '[0-9]+');
    Route::post('/users/{user}/posts', 'UserController@postsStore')
        ->where('user', '[0-9]+');
});
