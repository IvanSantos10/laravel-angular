<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function(){
    Route::resource('client', 'ClientController', ['except' => ['create', 'edit']]);

    Route::resource('project', 'ProjectsController', ['except' => ['create', 'edit']]);

    Route::group(['prefix' => 'project'], function(){

        Route::get('{id}/note', 'ProjectNotesController@index');
        Route::post('{id}/note', 'ProjectNotesController@store');
        Route::get('{id}/note/{noteId}', 'ProjectNotesController@show');
        //Route::put('{id}/note/{noteId}', 'ProjectNotesController@update');
        Route::delete('note/{id}', 'ProjectNotesController@destroy');

        Route::post('{id}/file', 'ProjectsFileController@store');
    });
});



