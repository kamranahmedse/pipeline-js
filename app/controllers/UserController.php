<?php

class UserController extends Controller {

	public function processRegister()
	{
		
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
