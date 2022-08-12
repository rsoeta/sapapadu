<?php

namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	public function index()
	{
		$data = [];


		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))
					->first();

				$this->setUserSession($user);
				//$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('pbb/pages');
			}
		}

		echo view('templates/header', $data);
		echo view('login');
		echo view('templates/footer');
	}

	public function verivali()
	{
		$data = [];
		helper(['form']);


		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email',
				'password' => 'required|max_length[255]|validateUser[email,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Email or Password don\'t match'
				]
			];

			if (!$this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$user = $model->where('email', $this->request->getVar('email'))
					->first();

				$this->setUserSession($user);
				//$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('pbb/pages');
			}
		}

		return view('verivali/login', $data);
	}

	private function setUserSession($user)
	{
		$data = [
			'id_user' => $user['id_user'],
			'nama_user' => $user['nama_user'],
			'hp' => $user['hp'],
			'email' => $user['email'],
			'status' => $user['status'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}

	public function register()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'nama_user' => 'required|max_length[50]',
				'hp' => 'required|numeric|min_length[10]|max_length[15]|is_unique[pbb_users.hp]',
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[pbb_users.email]',
				'password' => 'required|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {
				$model = new UserModel();

				$newData = [
					'nama_user' => $this->request->getVar('nama_user'),
					'hp' => $this->request->getVar('hp'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('users');
			}
		}


		echo view('templates/header', $data);
		echo view('register');
		echo view('templates/footer');
	}

	public function profile()
	{

		$data = [];
		helper(['form']);
		$model = new UserModel();

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
			];

			if ($this->request->getPost('password') != '') {
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}


			if (!$this->validate($rules)) {
				$data['validation'] = $this->validator;
			} else {

				$newData = [
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
				];
				if ($this->request->getPost('password') != '') {
					$newData['password'] = $this->request->getPost('password');
				}
				$model->save($newData);

				session()->setFlashdata('success', 'Successfuly Updated');
				return redirect()->to('/profile');
			}
		}

		$data['user'] = $model->where('id', session()->get('id'))->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}

	//--------------------------------------------------------------------

}
