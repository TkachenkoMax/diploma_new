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

//Login and logout rotes.
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Registration Routes.
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/error', ['as' => 'error', 'uses' => 'ErrorController@index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    //Contacts block routes.
    Route::prefix('contacts')->group(function () {
        Route::get('/list', [
            'as'         => 'contacts.list',
            'uses'       => 'UserController@contacts',
            'middleware' => 'aws'
        ]);

        Route::post('/delete-contact', [
            'as'         => 'contacts.delete',
            'uses'       => 'UserController@deleteContact',
        ]);

        Route::get('/management', [
            'as'         => 'contacts.management',
            'uses'       => 'UserController@management',
        ]);

        Route::post('/management/accept', [
            'as'         => 'contacts.management.accept',
            'uses'       => 'UserController@acceptRequest',
        ]);

        Route::post('/management/decline', [
            'as'         => 'contacts.management.decline',
            'uses'       => 'UserController@declineRequest',
        ]);
    });

    //Settings block routes.
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as'         => 'settings.index',
            'uses'       => 'UserController@settings',
            'middleware' => 'aws'
        ]);

        Route::post('/change-password', [
            'as'         => 'settings.change.password',
            'uses'       => 'UserController@changePassword'
        ]);

        Route::post('/change-information', [
            'as'         => 'settings.change.information',
            'uses'       => 'UserController@changeInformation'
        ]);

        Route::post('/change-photo', [
            'as'         => 'settings.change.photo',
            'uses'       => 'UserController@changePhoto'
        ]);

        Route::get('/delete-photo', [
            'as'         => 'settings.delete.photo',
            'uses'       => 'UserController@deletePhoto',
        ]);
    });

    //Admin block routes.
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/users', [
            'as'   => 'admin.users',
            'uses' => 'AdminController@index'
        ]);

        Route::get('/users/data', [
            'as'   => 'admin.users.data',
            'uses' => 'AdminController@getUsers'
        ]);

        Route::get('/user/{id}/view', [
            'as'    => 'admin.user.view',
            'uses'  => 'AdminController@viewUser'
        ]);

        Route::post('/user/{id}/roles', [
            'as'    => 'user.roles.update',
            'uses'  => 'AdminController@updateRoles'
        ]);

        Route::get('/user/{id}/delete', [
            'as'    => 'admin.user.delete',
            'uses'  => 'AdminController@deleteUser'
        ]);
    });
});