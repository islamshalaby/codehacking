<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/posts/{id}', ['as' => 'post.home', 'uses' => 'PostsController@post']);

// middleware for admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return view('admin.index');
    });
    // users
    Route::resource('/admin/users', 'AdminUsersController');

    // posts
    Route::resource('/admin/posts', 'AdminPostsController');

    // categories
    Route::resource('/admin/categories', 'AdminCategoriesController');

    // media
    Route::get('/admin/media', ['as' => 'admin.media.index', 'uses' => 'AdminMediasController@index']);

    Route::get('/admin/media/create', ['as' => 'admin.media.create', 'uses' => 'AdminMediasController@create']);

    Route::post('/admin/media/store', ['as' => 'admin.media.store', 'uses' => 'AdminMediasController@store']);

    route::delete('/admin/media/destroy/{id}', ['as' => 'admin.media.destroy', 'uses' => 'AdminMediasController@destroy']);

    // comments
    Route::resource('/admin/comments', 'AdminPostCommentsController');

    // replies
    Route::resource('/admin/comment/replies', 'AdminCommentsRepliesController');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/comments/reply', ['as' => 'comment.reply.create', 'uses' => 'AdminCommentsRepliesController@createReply']);
});

