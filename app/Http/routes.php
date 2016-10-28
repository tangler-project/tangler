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
//route to remove current user from knot
Route::get('/api/leaveKnot/{groupId}', 'UsersGroupController@leaveKnot');

//edit User
Route::post('/api/userUpdate', 'UsersController@update');
//delete User
Route::get('/api/deleteUser/{id}', 'UsersController@destroy');

//edit event
Route::post('/api/editEvent/{id}', 'EventsController@update');
//delete event
Route::get('/api/deleteEvent/{id}', 'EventsController@destroy');

//route to add the user to the knot
Route::post('/api/addKnot/', 'GroupsController@addUserToGroup');

Route::get('/api/posts', 'PostsController@index');
Route::post('/add/post','PostsController@store');
//replacing index to show only posts that are part of that group
Route::get('/api/posts/{id}', 'PostsController@show');


Route::get('/api/events', 'EventsController@index');
Route::post('/add/event','EventsController@store');
//getting events for the specific group by id
Route::get('/api/events/{id}', 'EventsController@show');


Route::get('/api/groups', 'GroupsController@index');
//calling to get the private groups specifically for the user logged in
Route::get('/api/private-groups', 'GroupsController@getPrivateGroups');

Route::get('/api/groups/{id}', 'GroupsController@show');
Route::post('/add/group', 'GroupsController@store');


Route::get('/', 'PostsController@home');
Route::get('/login', 'PostsController@welcome');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

