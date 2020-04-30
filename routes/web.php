<?php

use Illuminate\Support\Facades\Route;

// Back
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function () {
  Route::get('login','Back\AuthController@login')->name('login');
  Route::post('login','Back\AuthController@loginPost')->name('login.post');
});
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
  Route::get('/','Back\Dashboard@index')->name('dashboard');
  // ARTICLE ROUTES
  Route::resource('articles','Back\ArticleController');
  Route::get('delete_article','Back\ArticleController@delete')->name('delete_article');
  Route::get('article_deletes','Back\ArticleController@trashed')->name('trashed_article');
  Route::get('publish_article','Back\ArticleController@publish')->name('publish_article');
  // CATEGORY ROUTES
  Route::get('/categories','Back\CategoryController@index')->name('category.index');
  Route::get('/categories/cetagoryTable','Back\CategoryController@cetagoryTable')->name('category.table');
  Route::post('/categories/create','Back\CategoryController@create')->name('category.create');
  Route::post('/categories/update','Back\CategoryController@update')->name('category.update');
  Route::post('/categories/image_edit','Back\CategoryController@imageEdit')->name('category.image.edit');
  // CONTACT ROUTES
  Route::resource('/contacts','Back\ContactController');
  Route::post('delete_contact','Back\ContactController@delete')->name('contact.delete');
  //
  Route::get('logout','Back\AuthController@logout')->name('logout');
});


// Front
Route::get('/', 'Front\Home@index')->name('home');
Route::get('/contact', 'Front\Home@contact')->name('contact');
Route::post('/contact', 'Front\Home@contactPost')->name('contact_post');

Route::get('/category/{category}', 'Front\Home@category')->name('category');

Route::get('/{category}/{slug}', 'Front\Home@singleArticle')->name('single_article');
Route::get('/{page}', 'Front\Home@page')->name('page');
