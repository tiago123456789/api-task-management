<?php

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


Route::prefix("auth")
    ->group(function() {
        Route::post("/", "AuthEndpoint@login");
        Route::post("/logout", "AuthEndpoint@logout")->middleware("api");
        Route::post("/refresh", "AuthEndpoint@refresh")->middleware("api");
    });

Route::post("/users", "UserEndpoint@register")->middleware("handlerException");
Route::group([

        'middleware' => [ 'authenticatorAndAuthorizator', "handlerException"] ,
        'prefix' => 'tasks'

    ], function() {
        \Illuminate\Support\Facades\Route::get("/", "TaskController@findAll");
        Route::post("/", "TaskController@create");
        Route::delete("/{id}", "TaskController@remove");
        Route::put("/{id}", "TaskController@update");
        Route::get("/uncomplete", "TaskController@uncomplete");
        Route::get("/complete", "TaskController@complete");
        Route::get("/{id}", "TaskController@findById");
    });


