<?php

class HomeController extends BaseController {

    /**
     * index
     * 
     * Homepage of the website i.e. welcome page that will be shown to the non registered users
     */ 
	public function index()
	{
		return View::make('front.index');
	}

}
