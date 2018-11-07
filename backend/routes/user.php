<?php
/**
 * Created by PhpStorm.
 * User: devmaker
 * Date: 15/10/18
 * Time: 12:54
 */

Route::group(['namespace' => 'User'], function(){
    Route::post('login', 'UserController@login');
    Route::post('signup', 'UserController@store');

    Route::group(['middleware' => 'jwt:api'], function(){

        Route::get('me', 'UserController@me');

        Route::apiResource('employee', 'EmployeeController');

    });
});
