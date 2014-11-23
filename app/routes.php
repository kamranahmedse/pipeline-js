<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

// User Routes
Route::group(array('prefix' => 'user'), function () 
{	
	// Only guests can access this
	Route::group(array('before' => 'guest'), function()
	{
		Route::get('register', array('uses' => 'UserController@register', 'as' => 'registerUser'));
		Route::post('register', array('uses' => 'UserController@processRegister', 'as' => 'processRegisterUser'));

		Route::get('login', array('uses' => 'UserController@login', 'as' => 'loginUser'));
		Route::post('login', array('uses' => 'UserController@processLogin', 'as' => 'processLoginUser'));
	});

	// Only users can access this
	Route::group(array('before' => 'auth'), function()
	{
		Route::get('dashboard', array('uses' => 'UserController@dashboard', 'as' => 'userDashboard'));
		Route::get('profile', array('uses' => 'UserController@profile', 'as' => 'userProfile'));
		Route::get('logout', array('uses' => 'UserController@logout', 'as' => 'logoutUser'));
	});
});

// Bookmarks Routes
Route::group(array('prefix' => 'bookmark'), function(){

	// Only users can access this
	Route::group(array('before' => 'auth'), function()
	{
		Route::get('/', array('uses' => 'BookmarkController@index', 'as' => 'userBookmarks'));
	});
});