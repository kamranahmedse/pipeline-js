<?php

class HomeController extends Controller {

	public function index()
	{
		return View::make('front.index');
	}

}
