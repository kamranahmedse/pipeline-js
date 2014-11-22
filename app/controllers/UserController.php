<?php

class UserController extends BaseController {

	public function __construct( User $user ) 
	{
	    $this->beforeFilter('csrf', array('on'=>'post'));
	    $this->user = $user;
	}

	public function processRegister()
	{
		$validator = Validator::make(Input::all(), User::$rules);
 
	    if ($validator->passes()) {

		    $this->user->username = Input::get('username');
		    $this->user->email = Input::get('email');
		    $this->user->password = Hash::make(Input::get('password'));
		    
		    $this->user->save();
		 
		    return Redirect::to('user/login')->with('message', 'You have been successfuly registered. You may login now');
	    } else {
	        return Redirect::back()->withErrors($validator)->withInput();
	    }	
	}

	public function processLogin()
	{
		if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
		    return Redirect::to('user/dashboard');
		} else {
		    return Redirect::to('user/login')
		        ->with('message', 'Your username/password combination was incorrect')
		        ->withInput();
		}	
	}

	public function register()
	{
		return View::make('front.register');
	}

	public function login()
	{
		return View::make('front.login');
	}

	public function dashboard()
	{
		return View::make('backend.dashboard-nourls');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}
