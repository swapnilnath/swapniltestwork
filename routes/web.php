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

    //====================> comman controller and function================
Route::group(['middleware' => 'preventBackHistory'], function () {
    Route::get('/', 'FrontController@post_listing')->name('post_listing');
    Route::get('/post_listing_details/{slug}', 'FrontController@post_listing_details')->name('post_listing_details');
    //====================> Admin Auth Panel =========================
    //Route::get('/', 'Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::get('/admin', 'Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::get('admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::post('admin/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    //====================> Admin Auth Panel =========================

    //====================> Reset Password Panel =========================
    Route::get('admin/resetPassword', 'Admin\Auth\PasswordResetController@showPasswordRest')->name('admin.resetPassword');
    Route::post('admin/sendResetLinkEmail', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.sendResetLinkEmail');
    Route::get('admin/find/{token}', 'Admin\Auth\PasswordResetController@find')->name('admin.find');
    Route::post('admin/create', 'Admin\Auth\PasswordResetController@create')->name('admin.sendLinkToUser');
    Route::post('admin/reset', 'Admin\Auth\PasswordResetController@reset')->name('admin.resetPassword_set');
    //====================> Reset Password Panel =========================

    Route::group(['prefix' => 'admin','middleware'=>'Admin','namespace' => 'Admin','as' => 'admin.'], function () {
        Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
        //====================> Dashboard =========================
        Route::get('/', 'MainController@dashboard');
        Route::get('/dashboard', 'MainController@dashboard')->name('dashboard');
        //====================> Dashboard =========================

//        Route::get('/test', 'MainController@test')->name('test');
        //====================> User Management =========================
        Route::get('/profile', 'UsersController@updateProfile')->name('profile');
        Route::post('/updatePassword', 'UsersController@updatePassword')->name('updatePassword');
        Route::post('/updateProfileDetail', 'UsersController@updateProfileDetail')->name('updateProfileDetail');
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::post('/users/delete/{id}', 'UserController@delete')->name('users.delete');
        Route::post('/users/change_status', 'UserController@changeStatus')->name('users.change_status');
        Route::get('/users/profile/{id}', 'UserController@userProfile')->name('users.profile');

        //====================> Post Management =========================
        Route::get('/post', 'PostController@index')->name('post.index');
        Route::get('/post/create', 'PostController@create')->name('post.create');
        Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
        Route::post('/post/update/{id}', 'PostController@update')->name('post.update');
        Route::post('/post/delete/{id}', 'PostController@delete')->name('post.delete');
        Route::post('/post/store', 'PostController@store')->name('post.store');

        //====================> Post Management =========================
        Route::get('/role', 'PermissionController@role_index')->name('role.index');
        Route::get('/permission', 'PermissionController@permission')->name('permission.index');
        Route::get('/permission/create/{id}', 'PermissionController@create')->name('permission.create');
        Route::post('/permission/store', 'PermissionController@store')->name('permission.store');
    });

    Route::group(['middleware'=>'front','prefix' => 'front','namespace' => 'Front','as' => 'front.'], function () {
        Route::get('/', 'FrontController@post_listing')->name('post_listing');
        Route::get('/post_listing', 'FrontController@post_listing')->name('post_listing');
    });
});
