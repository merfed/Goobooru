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



Route::group(['prefix' => 'posts', 'middleware' => ['web']], function() {
    Route::get('/', 'Boorus@index')->name('posts');
    Route::get('/hot', 'Boorus@hot')->name('hotPosts');
    Route::get('/random', 'Boorus@random')->name('random');
    // Route::get('/urls', 'Controller@urls')->name('urlPosts');
    Route::get('/dcma', 'Boorus@dcma')->name('dcma');
    Route::get('/tos', 'Boorus@tos')->name('tos');
    // Route::get('/help', 'Boorus@help')->name('help');
});

Route::group(['prefix' => 'posts', 'middleware' => ['web', 'auth']], function() {
    Route::get('/upload', 'Boorus@create')->name('upload');
    Route::post('/upload', 'Boorus@store')->name('uploadPost');
    Route::get('/queue', 'Boorus@queue')->name('queue');
    Route::post('/queue/{id}', 'Boorus@processQueue')->name('processQueue');
});

Route::group(['prefix' => 'post', 'middleware' => ['web']], function() {
    Route::get('/{id}', 'Boorus@post')->name('post');
});

Route::group(['prefix' => 'pools', 'middleware' => ['web']], function() {
    Route::get('/', 'Pools@index')->name('pools');
});

Route::group(['prefix' => 'pools', 'middleware' => ['web', 'auth']], function() {
    Route::get('/new', 'Pools@create')->name('poolsCreate');
    Route::post('/new', 'Pools@store')->name('poolsPostCreate');
    Route::get('/add/post/{id}', 'Pools@addPost')->name('poolsAddPost');
    Route::post('/add/post/{id}', 'Pools@storePost')->name('poolsPostAddPost');
    Route::get('/add/posts', 'Pools@addPosts')->name('poolsBulkAddPost');
    Route::post('/add/posts', 'Pools@storePosts')->name('poolsPostBulkAddPost');
    Route::get('/add/tags', 'Pools@addTags')->name('poolsBulkAddTags');
    Route::post('/add/tags', 'Pools@storeTags')->name('poolsPostBulkAddTags');
});

Route::group(['prefix' => 'tags', 'middleware' => ['web']], function() {
    Route::get('/', 'Tags@index')->name('tags');
});

Route::group(['prefix' => 'tags', 'middleware' => ['web', 'auth']], function() {
    Route::get('/bulk', 'Tags@create')->name('tagsBulk');
    Route::post('/bulk', 'Tags@store')->name('tagsBulkPost');
});

Route::group(['prefix' => 'tag', 'middleware' => ['web']], function() {
    Route::get('/{tag}', 'Tags@getPosts')->name('tagPosts');
});

// Route::get('/notes', 'Notes@index')->name('notes');

Auth::routes();

Route::get('/profile/{id}', 'Users@profile')->name('profile');
Route::get('/settings', 'Users@settings')->name('userSettings');
Route::post('/settings/avatar', 'Users@uploadAvatar')->name('postAvatar');

Route::group(['prefix' => 'forum', 'middleware' => ['web', 'auth']], function() {
    Route::get('/', 'Forums@index')->name('forum');
    Route::get('/new', 'Forums@create')->name('newThread');
    Route::post('/new', 'Forums@store')->name('postNewThread');
    Route::get('/t/{id}', 'Forums@view')->name('forumThread');
    Route::post('/t/{id}', 'Forums@reply')->name('reply');
    Route::get('/b/{id}', 'Forums@category')->name('forumCategory');
});
