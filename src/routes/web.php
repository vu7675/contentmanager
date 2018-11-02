<?php

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
