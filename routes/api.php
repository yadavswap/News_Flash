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

Route::get('site_details','Api\SiteApiController@index');


Route::get('categories','Api\CategoryApiController@index');
Route::get('categories/{id}/posts','Api\CategoryApiController@posts');

Route::get('posts','Api\PostApiController@index');


Route::get('tags','Api\TagApiController@index');
Route::get('tags/{id}/posts','Api\TagApiController@posts');

Route::get('authors','Api\UserApiController@index');
Route::get('authors/{id}/posts','Api\UserApiController@posts');

Route::get('post/comment/{id}' , 'Api\CommentApiController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'user'], function () {
    Route::post('/login', 'Api\UserApiController@login');
    Route::post('/new_register', 'Api\UserApiController@register');
    Route::get('/user_logout', 'Api\UserApiController@logout')->middleware('auth:api');
    Route::get('/myPosts','Api\UserApiController@myPosts')->middleware('auth:api');
    Route::post('comments/posts/{id}' , 'Api\CommentApiController@store' )->middleware('auth:api');
    Route::post('savePost' , 'Api\PostApiController@store' )->middleware('auth:api');
});
