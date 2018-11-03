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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('/', 'BackendController@index')->name('admin.index');
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
    Route::resources([
        'pages' => 'PageController',
        'posts' => 'PostController',
        'categories' => 'CategoryController',
        'users' => 'UserController',
        'admins' => 'AdminController',
        'roles' => 'RoleController',
        'sliders' => 'SliderController',
    ]);
    //data
    Route::get('/pageData', 'DataController@pageData')->name('pageData');
    Route::get('/postData', 'DataController@postData')->name('postData');
    Route::get('/categoryData', 'DataController@categoryData')->name('categoryData');
    Route::get('/userData', 'DataController@userData')->name('userData');
    Route::get('/adminData', 'DataController@adminData')->name('adminData');
    Route::get('/roleData', 'DataController@roleData')->name('roleData');
    Route::get('/sliderData', 'DataController@sliderData')->name('sliderData');
});
