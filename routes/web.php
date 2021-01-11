<?php

// Route::get('mail', function () {
//         $user = App\User::find(1);
//         $password = '$asd1xk89';
//         return new App\Mail\UserCreated($user, $password);
// });

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

        //Route::view('home', 'admin.dashboard')->name('admin.dashboard');
        Route::get('home', 'AdminController@show')->name('admin.dashboard');
        
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
        Route::delete('posts/{post}/images/{image}', 'PostController@destroyImages')->name('admin.posts.destroy.images');
        Route::put('posts/{post}/approved', 'PostController@updateApproved')->name('admin.posts.update.approved');

        /* IMAGES */
        Route::get('images/{image}', 'ImageController@getImage')->name('admin.images.get');

        /* PERMISSIONS */
        Route::resource('permissions', 'PermissionController', ['as' => 'admin'])->only(['index', 'edit', 'update']);

        /* ROLES */
        Route::resource('roles', 'RoleController', ['as' => 'admin']);
        Route::get('roles/get/{role}', 'RoleController@getRole')->name('admin.roles.get');

        /* USERS */
        Route::resource('users', 'UserController', ['as' => 'admin']);
        Route::get('users/get/{user}', 'UserController@getUser')->name('admin.users.get');
        Route::get('users/{user}/profile', 'UserController@profile')->name('admin.users.profile');
        Route::get('users/{user}/profile/edit', 'UserController@editProfile')->name('admin.users.profile.edit');
        Route::put('users/{user}/profile', 'UserController@updateProfile')->name('admin.users.profile.update');
        Route::put('users/{user}/password', 'UserController@updatePassword')->name('admin.users.password');

        /* COMMENTS */
        Route::resource('comments', 'CommentController', ['as' => 'admin', 'except' => ['create', 'edit', 'show', 'update', 'store']]);
        Route::put('comments/{comment}/approved', 'CommentController@updateApproved')->name('admin.comments.update.approved');

});

/* COMMENTS ROUTES PUBLIC */
Route::get('admin/comments/get/{comment}', 'Admin\CommentController@getComment')->middleware('auth')->name('admin.comments.get');
Route::post('admin/comments', 'Admin\CommentController@store')->middleware('auth')->name('admin.comments.store');

/* USERS ROUTES PUBLIC */
Route::get('users/{user}/profile', 'SubscriberController@edit')->middleware('auth')->name('subscriber.profile');
Route::put('users/{user}/profile', 'SubscriberController@update')->middleware('auth')->name('subscriber.profile.update');


Auth::routes();
