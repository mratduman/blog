<?php

use Illuminate\Support\Facades\Route;
// Front
Route::get('/', 'Front\Home@index')->name('home');
Route::get('/contact', 'Front\Home@contact')->name('contact');
Route::post('/contact', 'Front\Home@contactPost')->name('contact_post');

Route::get('/category/{category}', 'Front\Home@category')->name('category');

Route::get('/{category}/{slug}', 'Front\Home@singleArticle')->name('single_article');
Route::get('/{page}', 'Front\Home@page')->name('page');
