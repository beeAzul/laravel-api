<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

Route::group(['prefix' => 'topics'], function() {
    Route::post('/', 'TopicController@store')-> middleware('auth:api'); // only logged user acceess this route
    Route::get('/', 'TopicController@index'); // Anyone can acceess this route
    Route::get('/{topic}', 'TopicController@show'); // Anyone can acceess this route
    Route::patch('/{topic}', 'TopicController@update')-> middleware('auth:api'); // Anyone can acceess this route
    Route::delete('/{topic}', 'TopicController@destroy')-> middleware('auth:api'); // Anyone can acceess this route
    // Post route group : /topics/topic_id/posts
    Route::group(['prefix' => '/{topic}/posts'], function() {
        Route::post('/', 'PostController@store')->middleware('auth:api');
        Route::patch('/{post}', 'PostController@update')->middleware('auth:api');
        Route::delete('/{post}', 'PostController@destroy')->middleware('auth:api');
    });
});
