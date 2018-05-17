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

    //Settings routes.
    Route::get('/settings', 'UserController@settings')->name('settings.index');
    Route::post('/settings/change-password', 'UserController@changePassword')->name('settings.change.password');
    Route::post('/settings/change-information', 'UserController@changeInformation')->name('settings.change.information');
    Route::post('/settings/change-photo', 'UserController@changePhoto')->name('settings.change.photo');

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