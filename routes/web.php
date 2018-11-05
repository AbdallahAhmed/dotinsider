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
Route::get('/', ['uses' => 'HomeController@index'])->name('index');
Route::get('/contact-us', ['uses' => 'HomeController@contactForm'])->name('contact-us.form');
Route::post('/contact-us', ['uses' => 'HomeController@contact'])->name('contact-us.store');
Route::get('/category/{slug}', ['uses' => 'CategoryController@show'])->name('category.show');
Route::get('/categories', ['uses' => 'CategoryController@index'])->name('categories');
Route::get('/video/{slug}', ['uses' => 'HomeController@show'])->name('posts.show');
Route::post('/subscribe', ['uses' => 'HomeController@subscribe'])->name('subscribe');
Route::get('/page/{slug}', ['uses' => 'PageController@show'])->name('pages.show');
Route::get('/video/{slug}', ['uses' => 'PostController@show'])->name('posts.show');
Route::post('/season', ['uses' => 'SeasonController@posts'])->name('season.posts');