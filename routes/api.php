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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('logout', 'Auth\AuthController@logout');
    Route::post('refresh', 'Auth\AuthController@refresh');
    Route::post('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::apiResource('movies', 'Api\MovieController')->middleware('jwt.auth');
Route::get('popularMovies', 'Api\MovieController@popularMovies')->middleware('jwt.auth');
Route::get('relatedMovies', 'Api\MovieController@relatedMovies')->middleware('jwt.auth');

Route::post('movies/{movie_id}/like', 'Api\LikeController@likeMovie')->middleware('jwt.auth');
Route::post('movies/{movie_id}/dislike', 'Api\DislikeController@dislikeMovie')->middleware('jwt.auth');

Route::get('genres', 'Api\GenreController@getGenres')->middleware('jwt.auth');

Route::apiResource('comments', 'Api\CommentController')->middleware('jwt.auth');

Route::apiResource('watchlist', 'Api\WatchlistController')->middleware('jwt.auth');