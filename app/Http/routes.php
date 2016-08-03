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

Route::get('/', function() {
    return view('phonebook');
});

Route::group(['prefix' => 'api'], function () {
    //route for inserting
    Route::post('/phonebook/create', 'PhonebookController@create');

    //route for deleting
    Route::post('/phonebook/delete', 'PhonebookController@delete');

    //route for updating
    Route::post('/phonebook/edit', 'PhonebookController@edit');

    //route for retrieving all
    Route::get('/phonebook/all', 'PhonebookController@getall');
});
