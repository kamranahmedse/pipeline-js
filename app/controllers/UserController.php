<?php

class UserController extends Controller {

	public function __construct( User $user ) {
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
		
	}

	public function register()
	{
		return View::make('front.register');
	}

	public function login()
	{
		return View::make('front.login');
	}
}
