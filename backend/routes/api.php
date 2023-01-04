<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');

    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', 'AuthController@logout');

        // Get data user logged in
        Route::get('info-user', 'AuthController@getUser');

        // Task statuses
        Route::get('task-statuses', 'TaskStatusController@index');
        Route::post('task-statuses', 'TaskStatusController@store');
        Route::put('task-statuses/{id}', 'TaskStatusController@update');
        Route::delete('task-statuses/{id}', 'TaskStatusController@destroy');

        //Task
        Route::get('tasks', 'TaskController@index');
        Route::get('tasks/{id}', 'TaskController@show');
        Route::post('tasks', 'TaskController@store');
        Route::patch('tasks/{id}', 'TaskController@update');
        Route::delete('tasks/{id}', 'TaskController@destroy');
    });
});
