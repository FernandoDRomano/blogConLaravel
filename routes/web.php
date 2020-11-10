<?php

/* PAGINAS PUBLICAS */
Route::view('/', 'public.blog')->name('pages.blog');
Route::view('/about', 'public.about')->name('pages.about');
Route::view('/archive', 'public.archive')->name('pages.archive');
Route::view('/contact', 'public.contact')->name('pages.contact');


Route::group(
    ['prefix' => 'admin', 'middleware' => ['auth', 'authorizedPersonalOnly'], 'namespace' => 'Admin']
    ,function () {
        Route::view('home', 'admin.dashboard')->name('admin.dashboard');
        Route::resource('categories', 'CategoryController', ['as' => 'admin']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
