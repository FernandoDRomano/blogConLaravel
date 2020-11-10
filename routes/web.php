<?php

/* PAGINAS PUBLICAS */
Route::view('/', 'public.blog')->name('pages.blog');
Route::view('/about', 'public.about')->name('pages.about');
Route::view('/archive', 'public.archive')->name('pages.archive');
Route::view('/contact', 'public.contact')->name('pages.contact');

Route::view('/admin/home', 'admin.dashboard')->name('admin.dashboard');
