<?php

namespace App\Controllers;

use App\Models\UserModel;


class Users extends BaseController
{
	protected $db;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
	}

	// ==============================
	// LIST USER
	// ==============================
	public function index()
	{
		$db = \Config\Database::connect();
		$user = session()->get();

		// ========================
		// DATA USER
		// ========================
		$builder = $db->table('pbb_users u');

		$builder->select('
			u.*,
			kec.name as kec_nama,
			v.name as desa_nama,
			dsn.td_nama_dusun as dusun_nama
		');

		$builder->join('tb_districts kec', 'kec.id = u.pu_kode_kec', 'left');
		$builder->join('tb_villages v', 'v.id = u.pu_kode_desa', 'left');
		$builder->join('tb_dusun dsn', 'dsn.td_kode_dusun = u.pu_kode_dusun AND dsn.td_kode_desa = u.pu_kode_desa', 'left');

		$builder->where('u.pu_deleted_at IS NULL');

		if ($user['pu_role_id'] == 1) {
			$builder->where('pu_kode_kec', $user['pu_kode_kec']);
		} elseif ($user['pu_role_id'] == 2) {
			$builder->where('pu_kode_desa', $user['pu_kode_desa']);
			$builder->where('pu_role_id', 3);
		} else {
			return redirect()->to('/unauthorized');
		}

		$data = [
			'title' => 'Daftar User',
			'users' => $builder->get()->getResultArray(), // = $builder->get()->getResultArray();
		];

		// ========================
		// DATA DESA (FIX BUG)
		// ========================
		$data['desa'] = $db->table('tb_villages') // <-- sesuaikan nama tabel kamu
			->where('district_id', $user['pu_kode_kec'])
			->get()
			->getResultArray();

		return view('users/index', $data);
	}

	// ==============================
	// STORE USER
	// ==============================
	public function store()
	{
		$db = \Config\Database::connect(); // <-- FIX

		$input = $this->request->getPost();
		$currentUser = session()->get();

		// ==========================
		// VALIDASI ROLE
		// ==========================
		$role = (int)$input['pu_role_id'];

		// Kolektor hanya boleh buat Kadus
		if ($currentUser['pu_role_id'] == 2 && $role != 3) {
			return redirect()->back()->with('error', 'Kolektor hanya bisa membuat Kadus');
		}

		// ==========================
		// VALIDASI WILAYAH
		// ==========================
		$kode_kec = $currentUser['pu_kode_kec'];
		$kode_desa = $input['pu_kode_desa'] ?? null;
		$kode_dusun = $input['pu_kode_dusun'] ?? null;

		if ($role == 2 && empty($kode_desa)) {
			return redirect()->back()->with('error', 'Kolektor wajib punya desa');
		}

		if ($role == 3 && empty($kode_dusun)) {
			return redirect()->back()->with('error', 'Kadus wajib punya dusun');
		}

		// Kolektor tidak boleh lintas desa
		if ($currentUser['pu_role_id'] == 2) {
			if ($kode_desa != $currentUser['pu_kode_desa']) {
				return redirect()->back()->with('error', 'Tidak boleh lintas desa');
			}
		}

		// ==========================
		// CEK DUPLIKASI EMAIL
		// ==========================
		$existing = $db->table('pbb_users')
			->where('pu_email', $input['pu_email'])
			->get()
			->getRowArray();

		// Jika email sudah ada, cek apakah usernya sudah dihapus atau belum
		if ($existing) {

			// kalau user pernah dihapus → restore
			if ($existing['pu_deleted_at'] != null) {

				$db->table('pbb_users')
					->where('pu_id', $existing['pu_id'])
					->update([
						'pu_deleted_at' => null,
						'pu_deleted_by' => null,
						'pu_status'     => 1,
						'pu_fullname'   => $input['pu_fullname'],
						'pu_username'   => $input['pu_username'],
						'pu_password'   => password_hash($input['pu_password'], PASSWORD_DEFAULT),
						'pu_role_id'    => $role,
						'pu_kode_kec'   => $kode_kec,
						'pu_kode_desa'  => $kode_desa,
						'pu_kode_dusun' => $kode_dusun,
						'pu_updated_by' => $currentUser['pu_username'],
					]);

				return redirect()->to('/users')->with('success', 'User berhasil dipulihkan (restore)');
			}

			// kalau masih aktif → tolak
			return redirect()->back()->with('error', 'Email sudah digunakan');
		}

		// ==========================
		// INSERT
		// ==========================
		$db->table('pbb_users')->insert([
			'pu_nik'            => $input['pu_nik'],
			'pu_email'          => $input['pu_email'],
			'pu_username'       => $input['pu_username'],
			'pu_fullname'       => $input['pu_fullname'],
			'pu_password'       => password_hash($input['pu_password'], PASSWORD_DEFAULT),
			'pu_role_id'        => $role,
			'pu_kode_prov'      => '32', // Kode Provinsi tetap
			'pu_kode_kab'       => '32.05', // Kode Kabupaten tetap
			'pu_kode_kec'       => $kode_kec,
			'pu_kode_desa'      => $kode_desa,
			'pu_kode_dusun'     => $kode_dusun,
			'pu_status'         => 1,
			'pu_created_by'     => $currentUser['pu_id'],
		]);

		return redirect()->to('/users')->with('success', 'User berhasil ditambahkan');
	}

	// ==============================
	// UPDATE USER
	// ==============================
	public function update($id)
	{
		$db = \Config\Database::connect(); // <-- FIX

		$input = $this->request->getPost();
		$currentUser = session()->get();

		$user = $db->table('pbb_users')
			->where('pu_id', $id)
			->get()
			->getRowArray();

		if (!$user) {
			return redirect()->back()->with('error', 'User tidak ditemukan');
		}

		// Scope check
		if ($currentUser['pu_role_id'] == 2) {
			if ($user['pu_kode_desa'] != $currentUser['pu_kode_desa']) {
				return redirect()->back()->with('error', 'Akses ditolak');
			}
		}

		// Kolektor hanya boleh edit Kadus
		if ($currentUser['pu_role_id'] == 2 && $user['pu_role_id'] != 3) {
			return redirect()->back()->with('error', 'Tidak boleh edit role ini');
		}

		$dataUpdate = [
			'pu_nik'        => $input['pu_nik'],
			'pu_fullname'   => $input['pu_fullname'],
			'pu_email'      => $input['pu_email'],
			'pu_username'   => $input['pu_username'],
			'pu_kode_desa'  => $input['pu_kode_desa'] ?? null,
			'pu_kode_dusun' => $input['pu_kode_dusun'] ?? null,
			'pu_updated_by' => $currentUser['pu_username'],
		];

		if (!empty($input['pu_password'])) {
			$dataUpdate['pu_password'] = password_hash($input['pu_password'], PASSWORD_DEFAULT);
		}

		$db->table('pbb_users')
			->where('pu_id', $id)
			->update($dataUpdate);

		return redirect()->to('/users')->with('success', 'User berhasil diupdate');
	}

	// ==============================
	// DELETE (SOFT DELETE)
	// ==============================
	public function delete($id)
	{
		$db = \Config\Database::connect(); // <-- FIX
		$currentUser = session()->get();

		$user = $db->table('pbb_users')
			->where('pu_id', $id)
			->get()
			->getRowArray();

		if (!$user) {
			return redirect()->back()->with('error', 'User tidak ditemukan');
		}

		// Scope check
		if ($currentUser['pu_role_id'] == 2) {
			if ($user['pu_kode_desa'] != $currentUser['pu_kode_desa']) {
				return redirect()->back()->with('error', 'Akses ditolak');
			}

			if ($user['pu_role_id'] != 3) {
				return redirect()->back()->with('error', 'Tidak boleh hapus role ini');
			}
		}

		$db->table('pbb_users')
			->where('pu_id', $id)
			->update([
				'pu_deleted_at' => date('Y-m-d H:i:s'),
				'pu_deleted_by' => $currentUser['pu_username'],
			]);

		return redirect()->to('/users')->with('success', 'User berhasil dihapus');
	}

	public function getDusun($kode_desa)
	{
		$db = \Config\Database::connect();

		$data = $db->table('tb_dusun')
			->where('td_kode_desa', $kode_desa)
			->get()
			->getResultArray();

		return $this->response->setJSON($data ?? []);
	}

	public function getUser($id)
	{
		$db = \Config\Database::connect();

		$user = $db->table('pbb_users')
			->where('pu_id', $id)
			->where('pu_deleted_at IS NULL')
			->get()
			->getRowArray();

		return response()->setJSON($user ?? []);
	}

	public function toggleStatus($id)
	{
		$db = \Config\Database::connect();
		$currentUser = session()->get();

		$user = $db->table('pbb_users')
			->where('pu_id', $id)
			->where('pu_deleted_at IS NULL')
			->get()
			->getRowArray();

		if (!$user) {
			return response()->setJSON(['status' => false, 'message' => 'User tidak ditemukan']);
		}

		// 🔒 Scope check
		if ($currentUser['pu_role_id'] == 2) {
			// Kolektor hanya boleh kadus di desanya
			if ($user['pu_kode_desa'] != $currentUser['pu_kode_desa'] || $user['pu_role_id'] != 3) {
				return response()->setJSON(['status' => false, 'message' => 'Akses ditolak']);
			}
		}

		// 🔁 Toggle
		$newStatus = $user['pu_status'] == 1 ? 0 : 1;

		$db->table('pbb_users')
			->where('pu_id', $id)
			->update([
				'pu_status'     => $newStatus,
				'pu_updated_by' => $currentUser['pu_username'],
			]);

		return response()->setJSON([
			'sukses' => 'Status user berhasil diperbarui',
			'new_status' => $newStatus
		]);
	}

	public function filter()
	{
		$db = \Config\Database::connect();
		$user = session()->get();

		$search = $this->request->getGet('search');
		$role   = $this->request->getGet('role');
		$desa   = $this->request->getGet('desa');
		$status = $this->request->getGet('status');

		// =========================
		// PAGINATION PARAM
		// =========================
		$page  = (int) ($this->request->getGet('page') ?? 1);
		if ($page < 1) $page = 1;

		$limit = (int) ($this->request->getGet('limit') ?? 10);
		if ($limit <= 0) $limit = 10;

		$offset = ($page - 1) * $limit;

		// =========================
		// SORT PARAM
		// =========================
		$sort  = $this->request->getGet('sort') ?? 'u.pu_id';
		$order = $this->request->getGet('order') ?? 'DESC';

		$allowedSort = ['u.pu_fullname', 'u.pu_username', 'u.pu_status', 'u.pu_id'];
		if (!in_array($sort, $allowedSort)) {
			$sort = 'u.pu_id';
		}

		$order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';

		// =========================
		// BASE QUERY
		// =========================
		$builder = $db->table('pbb_users u');

		$builder->select('
        u.*,
        kec.name as kec_nama,
        v.name as desa_nama,
        dsn.td_nama_dusun as dusun_nama
    ');

		$builder->join('tb_districts kec', 'kec.id = u.pu_kode_kec', 'left');
		$builder->join('tb_villages v', 'v.id = u.pu_kode_desa', 'left');
		$builder->join('tb_dusun dsn', 'dsn.td_kode_dusun = u.pu_kode_dusun AND dsn.td_kode_desa = u.pu_kode_desa', 'left');

		$builder->where('u.pu_deleted_at IS NULL');

		// =========================
		// SCOPE
		// =========================
		if ($user['pu_role_id'] == 1) {
			$builder->where('u.pu_kode_kec', $user['pu_kode_kec']);
		} elseif ($user['pu_role_id'] == 2) {
			$builder->where('u.pu_kode_desa', $user['pu_kode_desa']);
			$builder->where('u.pu_role_id', 3);
		}

		// =========================
		// SEARCH
		// =========================
		if (!empty($search)) {
			$builder->groupStart()
				->like('u.pu_fullname', $search)
				->orLike('u.pu_username', $search)
				->orLike('u.pu_email', $search)
				->groupEnd();
		}

		// =========================
		// FILTER
		// =========================
		if ($role !== '' && $role !== null) {
			$builder->where('u.pu_role_id', $role);
		}

		if ($desa !== '' && $desa !== null) {
			$builder->where('u.pu_kode_desa', $desa);
		}

		if ($status !== '' && $status !== null) {
			$builder->where('u.pu_status', $status);
		}

		// =========================
		// TOTAL COUNT (SEBELUM LIMIT & ORDER)
		// =========================
		$countBuilder = clone $builder;
		$total = $countBuilder->countAllResults();

		// =========================
		// ORDERING (INI POSISI YANG BENAR)
		// =========================
		$builder->orderBy($sort, $order);

		// =========================
		// DATA PAGINATION
		// =========================
		$users = $builder
			->limit($limit, $offset)
			->get()
			->getResultArray();

		// =========================
		// RETURN VIEW
		// =========================
		return view('users/table_partial', [
			'users' => $users,
			'total' => $total,
			'limit' => $limit,
			'page'  => $page,
		]);
	}

	public function checkUnique()
	{
		$db = \Config\Database::connect();

		$field = $this->request->getGet('field'); // pu_email | pu_username | pu_nik
		$value = $this->request->getGet('value');
		$id    = $this->request->getGet('id');

		// ✅ whitelist (DITAMBAH pu_nik)
		if (!in_array($field, ['pu_email', 'pu_username', 'pu_nik'])) {
			return response()->setJSON(['error' => 'Field tidak valid']);
		}

		$builder = $db->table('pbb_users')
			->where($field, $value)
			->where('pu_deleted_at IS NULL');

		if (!empty($id)) {
			$builder->where('pu_id !=', $id);
		}

		$exists = $builder->countAllResults() > 0;

		return response()->setJSON([
			'exists' => $exists
		]);
	}

	public function resetPassword($id)
	{
		$db = \Config\Database::connect();
		$currentUser = session()->get();

		$user = $db->table('pbb_users')
			->where('pu_id', $id)
			->where('pu_deleted_at IS NULL')
			->get()
			->getRowArray();

		if (!$user) {
			return response()->setJSON(['error' => 'User tidak ditemukan']);
		}

		// 🔒 Scope (kolektor hanya kadus di desanya)
		if ($currentUser['pu_role_id'] == 2) {
			if ($user['pu_kode_desa'] != $currentUser['pu_kode_desa'] || $user['pu_role_id'] != 3) {
				return response()->setJSON(['error' => 'Akses ditolak']);
			}
		}

		// 🔑 Password default
		$nik = $user['pu_nik'] ?? '';

		if (strlen($nik) >= 6) {
			$defaultPassword = substr($nik, -6);
		} else {
			$defaultPassword = '123456'; // fallback
		}

		$db->table('pbb_users')
			->where('pu_id', $id)
			->update([
				'pu_password' => password_hash($defaultPassword, PASSWORD_DEFAULT),
				'pu_force_pass_reset' => 1,
				'pu_updated_by' => $currentUser['pu_username'],
			]);

		return response()->setJSON([
			'sukses' => 'Password direset ke 6 digit terakhir NIK'
		]);
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
