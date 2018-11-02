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


Route::group(['prefix'=> 'admin'], function() {
    Route::get('/', '\VincentNt\ContentManager\Controllers\HomeController@index')->name('admin.index');
    Route::resources([
        'pages' => '\VincentNt\ContentManager\Controllers\PageController',
    ]);
    Route::get('/pageData', '\VincentNt\ContentManager\Controllers\DataController@pageData')->name('pageData');
    Route::get('/login', '\VincentNt\ContentManager\Controllers\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', '\VincentNt\ContentManager\Controllers\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', '\VincentNt\ContentManager\Controllers\LoginController@logout');
});
