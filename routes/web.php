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

Route::get('/', 'Landing@index')->name('landing');

Route::get('/posts', 'Boorus@index')->name('posts');
Route::get('/posts/upload', 'Boorus@create')->name('upload');
Route::post('/posts/upload', 'Boorus@store')->name('uploadPost');
Route::get('/posts/hot', 'Boorus@hot')->name('hotPosts');
Route::get('/posts/random', 'Boorus@random')->name('random');
// Route::get('/posts/urls', 'Controller@urls')->name('urlPosts');
Route::get('/posts/dcma', 'Boorus@dcma')->name('dcma');
Route::get('/posts/tos', 'Boorus@tos')->name('tos');
Route::get('/posts/queue', 'Boorus@queue')->name('queue');
Route::post('/posts/queue/{id}', 'Boorus@processQueue')->name('processQueue');
// Route::get('/posts/help', 'Boorus@help')->name('help');

Route::get('/post/{id}', 'Boorus@post')->name('post');

Route::get('/pools', 'Pools@index')->name('pools');
Route::get('/pools/new', 'Pools@create')->name('poolsCreate');
Route::post('/pools/new', 'Pools@store')->name('poolsPostCreate');
Route::get('/pools/add/post/{id}', 'Pools@addPost')->name('poolsAddPost');
Route::post('/pools/add/post/{id}', 'Pools@storePost')->name('poolsPostAddPost');
Route::get('/pools/add/posts', 'Pools@addPosts')->name('poolsBulkAddPost');
Route::post('/pools/add/posts', 'Pools@storePosts')->name('poolsPostBulkAddPost');
Route::get('/pools/add/tags', 'Pools@addTags')->name('poolsBulkAddTags');
Route::post('/pools/add/tags', 'Pools@storeTags')->name('poolsPostBulkAddTags');

// Route::get('/notes', 'Notes@index')->name('notes');

Route::get('/tags', 'Tags@index')->name('tags');
Route::get('/tags/bulk', 'Tags@create')->name('tagsBulk');
Route::post('/tags/bulk', 'Tags@store')->name('tagsBulkPost');

Route::get('/tag/{tag}', 'Tags@getPosts')->name('tagPosts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
