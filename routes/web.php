<?php

use Illuminate\Support\Facades\Route;

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

    Route::group(['middleware' => ['guest:user']], function () {
        // Authentication Routes
        Route::get('login', '\App\Http\Controllers\Auth\LoginController@index')->name('user.login');
        Route::post('login', '\App\Http\Controllers\Auth\LoginController@log_in')->name('login.post');

        Route::get('logout', '\App\Http\Controllers\Auth\LoginController@log_out')->name('logout');

        // Registration Routes
        Route::get('signup', '\App\Http\Controllers\Auth\RegisterController@index')->name('user.signup');
        Route::post('signup', '\App\Http\Controllers\Auth\RegisterController@registrationIndividual')->name('signup.post');

        // Password Reset Routes
        Route::get('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.email');
        Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@send_ResetLinkEmail')->name('password.email.post');

        Route::get('password/reset/{token}{email?}', '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
        Route::post('password/reset', '\App\Http\Controllers\Auth\ResetPasswordController@reset_pass')->name('password.update');


    });

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', '\App\Http\Controllers\Frontend\HomeController@index')->name('home');
});


//Admin routes
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    //User Management
    Route::post('user/table', 'Users\UserController@table')->name('user.table');
    Route::resource('user', 'Users\UserController');

    // Specific User
    Route::group(['prefix' => 'user/{user}'], function () {
        // Status
        Route::get('mark/{status}', 'Users\UserController@mark')->name('user.mark')->where(['status' => '[1,2]']);
        // Access
        Route::get('login-as', 'Users\UserController@loginAs')->name('user.login-as');
    });

    //Roles Management
    Route::resource('role', 'Roles\RoleController');
    Route::post('role/table', 'Roles\RoleController@table')->name('role.table');
});



