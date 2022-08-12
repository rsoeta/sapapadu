<?php

namespace App\Controllers;

class Lockscreen extends BaseController
{
	public function index()
	{
		$data = [
			'namaApp' => 'bend',
			'title' => 'Access Denied',
		];

		return view('lockscreen', $data);
	}
}
