<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Menu extends BaseController
{
	public function menuAdmin()
	{
		if (session()->get('level') <> 1) {
			return redirect()->to(base_url('pbb/user'));
		}
		$data = [
			'title' => 'Menu Admin',
			'isi' => 'menu'
		];
		return view('pbb/templates/menu', $data);
	}

	public function menuUser()
	{
		if (session()->get('level') <> 2) {
			return redirect()->to(base_url('pbb/user'));
		}
		$data = [
			'title' => 'Menu User',
			'isi' => 'menu'
		];
		return view('pbb/templates/menu', $data);
	}

	public function menuGuest()
	{
		if (session()->get('level') <> 3) {
			return redirect()->to(base_url('pbb/user'));
		}
		$data = [
			'title' => 'Menu Guest',
			'isi' => 'menu'
		];
		return view('pbb/templates/menu', $data);
	}
}
