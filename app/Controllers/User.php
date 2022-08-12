<?php

namespace App\Controllers;

use App\Models\DhkpModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {

        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'My Profile',
        ];
        return view('pbb/pages/index', $data);
    }
    public function detail($id_user)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->getUser($id_user)
        ];

        // jika user tidak ada di tabel
        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID User ' . $id_user . ' tidak ditemukan.');
        }

        return view('pbb/admin/detail', $data);
    }

    public function detailDhkp($id_sppt)
    {
        $data = [
            'title' => 'Detail SPPT',
            'Dhkp' => $this->dhkpModel->getDhkp($id_sppt)
        ];
        return view('dhkp/detailDhkp', $data);
    }
    public function create()
    {
        // session();
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        return view('pbb/admin/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama user harus diisi.'
                ]
            ],
            'hp' => [
                'rules' => 'required|numeric|min_length[11]',
                'errors' => [
                    'required' => 'no. hp harus diisi.',
                    'numeric' => 'no. hp harus berisi angka',
                    'min_length' => 'no. hp tidak benar'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'status harus diisi.'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/admin/create')->withInput()->with('validation', $validation);
            return redirect()->to('/pbb/admin/create')->withInput();
        }


        // ambil foto
        $fileFoto = $this->request->getFile('foto');
        // apakah tidak ada gambar yang di upload
        if ($fileFoto->getError() == 4) {
            $namaFoto = 'default.png';
        } else {
            // gnerate nama foto random
            $namaFoto = $fileFoto->getRandomName();

            // pindahkan file ke folder img
            $fileFoto->move('img', $namaFoto);
        }

        $this->userModel->save([
            'nama_user' => $this->request->getVar('nama_user'),
            'hp' => $this->request->getVar('hp'),
            'password' => $this->request->getVar('password'),
            'status' => $this->request->getVar('status'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/pbb/admin');
    }

    public function delete($id_user)
    {
        // cari gambar berdasarkan id
        $user = $this->userModel->find($id_user);

        //cek jika file gambarnya default.png
        if ($user['foto'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $user['foto']);
        }

        $this->userModel->delete($id_user);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/pbb/admin');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'user' => $this->userModel->getUser($id)
        ];
        return view('pbb/admin/edit', $data);
    }

    public function update($id)
    {
        // cek duplikat
        //  $userlama = $this->userModel->getUser($this->request->getVar('id_user'));
        //  if($userlama['nama_user']==$this->request->getVar('nama_user')){
        //      $rule_namauser = 'required';
        //  } else {
        //      $rule_namauser='required|is_unique[admin.nama]';
        //  }

        if (!$this->validate([
            'username' => [
                // 'rules' => $rule_namauser,
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama user harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password harus diisi.'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'status harus diisi.'
                ]
            ],
            'user_image' => [
                'rules' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'ukuran foto terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/pbb/admin/edit/' . $this->request->getVar('id'))->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        //cek gambar, apakah tetap gambar lama
        if ($fileFoto->getError() == 4) {
            $namaFoto = $this->request->getVar('fotoLama');
        } else {
            // generate nama file random
            $namaFoto = $fileFoto->getRandomName();
            // pindahkan gambar
            $fileFoto->move('img', $namaFoto);
            //hapus file yang lama
            unlink('img/' . $this->request->getVar('fotoLama'));
        }

        $this->userModel->save([
            'id_user' => $id_user,
            'nama_user' => $this->request->getVar('nama_user'),
            'hp' => $this->request->getVar('hp'),
            'password' => $this->request->getVar('password'),
            'status' => $this->request->getVar('status'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/pbb/admin');
    }
}
