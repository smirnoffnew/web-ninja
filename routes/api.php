<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------|
*/

Route::group([
    'middleware' => 'cors'
], function() {
    Route::post('signin', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => ['auth:api', 'verified']
    ], function() {
        Route::get('logout', 'AuthController@logout');

        Route::get('currentUser', 'AuthController@getCurrentUser');
        Route::put('currentUser', 'AuthController@updateCurrentUser');

        Route::get('users', 'UserController@getUsers');
        Route::get('users/{id}', 'UserController@getUser')->where('id', '[0-9]+');

        Route::group([
            'middleware' => 'admin'
        ], function() {
            Route::post('users', 'UserController@createUser');
            Route::delete('users/{id}', 'UserController@deleteUser')->where('id', '[0-9]+');
            Route::put('users/{id}', 'UserController@updateUser')->where('id', '[0-9]+');
        });
    });
});
