<?php

/**
 * UserController to handle all the user related actions
 */ 
class UserController extends BaseController {

	public function __construct( User $user, Bookmark $bookmark ) 
	{
	    $this->beforeFilter('csrf', array('on'=>'post'));

	    $this->user = $user;
	    $this->bookmark = $bookmark;

	    $this->userInfo = Auth::user();
	}

	/**
	 * Handles the register form submission. Registers a new user if the validations passes or redirects backs with errors.
	 */ 
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

	/**
	 * Handles the login form submission. Redirects back with errors if validation fails, logs in the user otherwise
	 */ 
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

	/**
	 * Register view
	 */ 
	public function register()
	{
		return View::make('front.register');
	}

	/**
	 * Login form
	 */ 
	public function login()
	{
		return View::make('front.login');
	}

	/**
	 * Handles the profile form submission to update the profile
	 */ 
	public function updateProfile()
	{
		$validator = Validator::make( Input::all(), User::$profileRules, User::$profileMessages );

		// Password will be required and it must be equal to the old password
		// ..if the user has entered a new password
		$validator->sometimes('password', 'required|is_old_password', function ( $input ) {
			return isset( $input->newpassword ) && !empty( $input->newpassword );
		});

		if ( $validator->passes() ) {
		
			$this->user = $this->user->find( $this->userInfo->id );

			$this->user->firstname = Input::get('firstname');
			$this->user->lastname = Input::get('lastname');

			if ( Input::get('newpassword', false) ) {
				$this->user->password = Hash::make( Input::get('newpassword') );
			}
			
			$this->user->save();

			return Redirect::back()->with('message', 'Profile successfuly updated');

		} else {
			return Redirect::back()->withErrors( $validator );
		}
	}

	/**
	 * Dashboard view
	 */ 
	public function dashboard()
	{
		$bookmarks = $this->user->getBookmarks( $this->userInfo->id );

		if ( count( $bookmarks ) !== 0 ) {
			return View::make('backend.dashboard-hasurls', compact('bookmarks'))
						->nest('shortUrlList', 'backend.partials.shorturl-list', compact('bookmarks'));
		} else {
			return View::make('backend.dashboard-nourls');
		}
	}

	/**
	 * Profile View
	 */ 
	public function profile()
	{
		$user = $this->user->find( $this->userInfo->id );
		return View::make('backend.profile', compact('user'));
	}

	/**
	 * Logs out the user and redirects to the login page
	 */ 
	public function logout()
	{
		Auth::logout();
		return Redirect::route('loginUser');
	}
}
