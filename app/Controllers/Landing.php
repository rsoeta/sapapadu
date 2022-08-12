<?php

namespace App\Controllers;

class Landing extends BaseController
{
	public function index()
	{
		// echo 'Hello World!';
		return view('landing');
	}
}
