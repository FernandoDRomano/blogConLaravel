<?php

/* PAGINAS PUBLICAS */
Route::get('/', 'BlogController@index')->name('pages.blog');
Route::get('/post/{post}', 'BlogController@show')->name('pages.show.post');
Route::get('/category/{category}/posts', 'BlogController@showPostsByCategory')->name('pages.category.show.posts');
Route::get('/tag/{tag}/posts', 'BlogController@showPostsByTag')->name('pages.tag.show.posts');


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

        /* POSTS */
        Route::get('posts/get/{post}', 'PostController@getPost')->name('admin.posts.get');
        Route::resource('posts', 'PostController', ['as' => 'admin']);
        Route::post('posts/{post}/images', 'PostController@uploadImages')->name('admin.posts.upload.images');
        Route::delete('posts/images/{image}', 'PostController@destroyImages')->name('admin.posts.destroy.images');

        /* IMAGES */
        Route::get('images/{image}', 'ImageController@getImage')->name('admin.images.get');

        /* PERMISSIONS */
        Route::resource('permissions', 'PermissionController', ['as' => 'admin'])->only(['index', 'edit', 'update']);

        /* ROLES */
        Route::resource('roles', 'RoleController', ['as' => 'admin']);
        Route::get('roles/get/{role}', 'RoleController@getRole')->name('admin.roles.get');

});


Auth::routes();
