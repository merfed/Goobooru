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
// Route::get('/posts/hot', 'Controller@hot')->name('hotPosts');
// Route::get('/posts/random', 'Controller@random')->name('randomPosts');
// Route::get('/posts/urls', 'Controller@urls')->name('urlPosts');
Route::get('/posts/dcma', 'Boorus@dcma')->name('dcma');
Route::get('/posts/tos', 'Boorus@tos')->name('tos');
// Route::get('/posts/help', 'Boorus@help')->name('help');

Route::get('/post/{id}', 'Boorus@post')->name('post');

// Route::get('/notes', 'Notes@index')->name('notes');

Route::get('/tags', 'Tags@index')->name('tags');
Route::get('/tags/bulk', 'Tags@create')->name('tagsBulk');
Route::post('/tags/bulk', 'Tags@store')->name('tagsBulkPost');
