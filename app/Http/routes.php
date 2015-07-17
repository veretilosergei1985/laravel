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

Route::get('/', 'PostController@index');

//Route::get('post/create', 'PostController@create');

Route::match(['get','post'], 'post/create/{id}', [
    'uses' => 'PostController@create',
    'as' => 'post.create'
]);

Route::match(['get'], 'post/delete/{id}', [
    'uses' => 'PostController@delete',
    'as' => 'post.delete'
]);

Route::match(['get'], 'post/view/{id}', [
    'uses' => 'PostController@view',
    'as' => 'post.view'
]);

Route::match(['get','post'], 'post/create', [
    'uses' => 'PostController@create',
    'as' => 'post.create'
]);

Route::match(['get'], 'post/index', [
    'uses' => 'PostController@index',
    'as' => 'post.index'
]);

Route::match(['post'], 'comment/add/{id}', [
    'uses' => 'CommentController@add',
    'as' => 'comment.add'
]);

//Route::get('/post/edit/{id}', 'PostController@edit');
//Route::post('/post/edit/{id}', 'PostController@edit');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
