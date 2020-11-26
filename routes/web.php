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
        
        /* CATEGORIES */
        Route::get('categories/all', 'CategoryController@all')->name('admin.categories.all');
        Route::get('categories/get/{category}', 'CategoryController@getCategory')->name('admin.categories.get');
        Route::resource('categories', 'CategoryController', ['as' => 'admin'])
                ->only(['index', 'store', 'update', 'destroy']);

        /* TAGS */
        Route::get('tags/all', 'TagController@all')->name('admin.tags.all');
        Route::get('tags/get/{tag}', 'TagController@getTag')->name('admin.tags.get');
        Route::resource('tags', 'TagController', ['as' => 'admin'])
                ->only(['index', 'store', 'update', 'destroy']);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
