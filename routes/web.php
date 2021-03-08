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
Auth::routes();//authentication routes
Route::get('/logout','UserController@logout')->name('user.logout');//all-logout

Route::get('/clear',function (){
   Artisan::call('config:cache');
   return "Cache cleared";
});

//guest routes//
Route::get('/','UserController@home')->name('user.home');//index
Route::get('/post/{post}','UserController@showSinglePost');//display single post
Route::get('/category/posts/{category}','UserController@categoryPosts');//display posts by category
Route::get('/tag/posts/{tag}','UserController@tagPosts');//display posts by tag



//User Routes//
Route::middleware(['auth','user'])->group(function (){
    Route::get('/my-dashboard','UserController@dashboard')->name('user.dashboard');//dashboard-view
    Route::post('/my-dashboard/update-avatar', 'UserController@update_avatar')->name('update.avatar');//dashboard-update-avatar
    Route::get('/user/check-pwd','UserController@chkPassword');//dashboard-check-password
    Route::match(['get', 'post'], '/user/update-pwd','UserController@updatePassword');//dashboard-update-password
    Route::get('/my-posts','UserController@myPosts')->name('user.post');//author's posts
    Route::get('/create-new-post','UserController@newPost')->name('add-new-post');//add new author post
    Route::post('save-new-post','UserController@store')->name('save-new-post');//save author post
    Route::match(['get', 'post'], 'add-post-comment','UserController@addComment')->name('add.post-comment');//author comment
});


//Admin Routes//
Route::middleware(['auth','admin'])->group(function (){

    Route::get('/admin/dashboard', 'HomeController@index')->name('home');//Admin Dashboard view

    //Admin category routes
    Route::get('/categories','CategoryController@index')->name('categories');//category-list
    Route::match(['get', 'post'], '/admin/add-category','CategoryController@store')->name('add-category');//add new category
    Route::match(['get', 'post'], '/admin/edit-category/{id}','CategoryController@update')->name('edit-category');//edit category
    Route::match(['get', 'post'], '/admin/delete-category/{id}','CategoryController@delete');//delete category

    //Admin tag routes
    Route::get('/tags','TagController@index')->name('tags');//tag-list
    Route::match(['get', 'post'], '/admin/add-tag','TagController@store')->name('add-tag');//add tag
    Route::match(['get', 'post'], '/admin/edit-tag/{id}','TagController@update')->name('edit-tag');//edit tag
    Route::match(['get', 'post'], '/admin/delete-tag/{id}','TagController@delete')->name('delete-tag');//delete tag

    //Admin comments routes
    Route::get('/comments','CommentController@index')->name('comments');//comments-list
    Route::match(['get', 'post'], 'add-comment','CommentController@store')->name('add-comment');//add comment
    Route::match(['get', 'post'], '/admin/delete-comment/{id}','CommentController@delete')->name('delete-comment');//delete comment

    //Admin users routes
    Route::get('/users','AdminController@listUser')->name('users');//users-lists
    Route::match(['get', 'post'], '/admin/delete-user/{id}','AdminController@delete')->name('delete-user');//delete-user

    //Admin posts routes
    Route::get('/posts','PostController@index')->name('posts');//all posts
    // Route::post('/import/posts','PostController@importPosts')->name('import.posts');//all posts
    Route::get('/posts/import', 'PostController@GetimportPosts')->name('import.posts');

    Route::post('/posts/import', 'PostController@importPosts')->name('import.posts');

    Route::get('/posts/{id}','PostController@show')->name('show-post');//single-post-view
    Route::get('new-post','PostController@newPost')->name('add-post');//create-new-post
    Route::post('new-post','PostController@store')->name('save-post');//save-new-post
    Route::match(['get', 'post'], '/posts/edit/{id}','PostController@edit')->name('edit-post');
    Route::match(['get', 'post'], '/admin/delete-post/{id}','PostController@delete')->name('delete-post');//delete post


    //Admin Site settings routes
    Route::get('/site-settings','AdminController@siteSettings')->name('posts');//settings view
    Route::post('/site-settings/update-logo', 'AdminController@updateLogo')->name('update.logo');//update-site-logo
    Route::match(['get', 'post'],'/site-settings/update-others', 'AdminController@updateOthers')->name('update.others');//update-site-details


    //Admin's Details Change routes
    Route::post('/site-settings/update-admin-avatar', 'AdminController@updateAdminAvatar')->name('update.adminAvatar');//update-admin-avatar
    Route::match(['get', 'post'],'/site-settings/update-admin-details', 'AdminController@updateAdminDetails')->name('update.adminDetails');//update-admin-details
    Route::get('/admin/check-pwd','AdminController@checkAdminPassword');//check-admin-password
    Route::match(['get', 'post'], '/admin/update-pwd','AdminController@updateAdminPassword');//update-admin-password

});

//Artisan routes//
Route::get('/clear_cache', function() {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return "All Cache cleared!";
});
Route::get('/storage_link', function () {
    Artisan::call('storage:link');
    return "Storage Linked!";
});
