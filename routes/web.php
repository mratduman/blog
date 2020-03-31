<?php

use Illuminate\Support\Facades\Route;

// Back
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
  Route::get('login','Back\AuthController@login')->name('login');
  Route::post('login','Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
  Route::get('/','Back\Dashboard@index')->name('dashboard');
  Route::resource('articles','Back\ArticleController');
  Route::get('logout','Back\AuthController@logout')->name('logout');
});


// Front
Route::get('/', 'Front\Home@index')->name('home');
Route::get('/contact', 'Front\Home@contact')->name('contact');
Route::post('/contact', 'Front\Home@contactPost')->name('contact_post');

Route::get('/category/{category}', 'Front\Home@category')->name('category');

Route::get('/{category}/{slug}', 'Front\Home@singleArticle')->name('single_article');
Route::get('/{page}', 'Front\Home@page')->name('page');
