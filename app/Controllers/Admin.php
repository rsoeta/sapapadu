<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pbb\UserModel;
use App\Models\Pbb\DhkpModel22;
use App\Models\Pbb\AuthModel;
use App\Models\WilayahModel;
use App\Models\RoleModel;
use App\Models\GenModel;
use App\Models\LembagaModel;

class Admin extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->wilayahModel = new WilayahModel();
        $this->dhkpModel22 = new DhkpModel22();
        $this->roleModel = new RoleModel();
        $this->GenModel = new GenModel();
        $this->AuthModel = new AuthModel();
        $this->LembagaModel = new LembagaModel();
    }
    public function index()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/user'));
        }

        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'Users',
            'user' => $this->userModel->getUser()
        ];
        return view('pbb/admin/index', $data);
    }

    public function detail()
    {
        $user_id = detailUser()->pu_id;
        $user_role = detailUser()->pu_role_id;

        $getAjax = $this->wilayahModel->getAjaxSearch()->getResultArray();
        foreach ($getAjax as $row) {
            $nama_kab = $row['nama_kab'];
            $nama_kec = $row['nama_kec'];
            $nama_desa = $row['nama_desa'];
        }

        if (detailUser()->pu_role_id == 1) {
            $user_role = 'Kecamatan';
            $nama_pemerintah = $nama_kec;
        } else {
            $user_role = 'Desa';
            $nama_pemerintah = $nama_desa;
        }

        $data = [
            'title' => 'Detail User',
            'roles' => $this->roleModel->getRole()->getResult(),
            'statusRole' => $this->GenModel->getStatusRole(),
            'user_id' => $user_id,
            'user_login' => $this->AuthModel->getUserId(),
            'lembaga' => $this->LembagaModel->getLembaga($user_id = false),
            'getAjax' => $this->wilayahModel->getAjaxSearch()->getResultArray(),
            'user_role' => $user_role,
            'nama_pemerintah' => $nama_pemerintah,
            'dataSls' => $this->getDataRtRwDusun(),
        ];
        // dd($data['getAjax']);

        // dd($data['roles']);

        // foreach ($users as $user) {
        //     $data = [
        //         'user' => $user
        //     ];
        // }

        // dd($data);

        // jika user tidak ada di tabel
        if (empty($data)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID User ' . $user_id . ' tidak ditemukan.');
        }

        // return view('pbb/admin/detail', $data);
        return view('pbb/admin/profil_user', $data);
    }

    public function update_user()
    {
        if ($this->request->isAJAX()) {
            // var_dump($this->request->getPost());

            $id_user = $this->request->getPost('id_user');
            $fullname = $this->request->getPost('fullname');
            $nik = $this->request->getPost('nik');
            $email = $this->request->getPost('email');
            $nope = $this->request->getPost('nope');
            $user_lembaga_id = $this->request->getPost('user_lembaga_id');

            $namaFileGambar = 'profil_' . $nik . '.jpg';
            $path = 'img/' . $namaFileGambar;
            if (file_exists($path)) {
                unlink($path);
            }

            // ambil gambar
            $file_gambar = $this->request->getFile('fp_user');
            // dd($file_gambar);

            if ($file_gambar->getError() == 4) {
                $nama_gambar = 'img/default.png';
            } else {
                // // generate nama file
                // $nama_gambar = $file_gambar->getRandomName();

                // pindahkan file ke folder profil
                $file_gambar->move('img', $namaFileGambar);

                //ambil nama file
                $nama_gambar = $namaFileGambar;
            }

            $personalData = [
                'pu_id' => $id_user,
                'pu_fullname' => $fullname,
                'pu_nik' => $nik,
                'pu_email' => $email,
                'pu_nope' => $nope,
                'pu_user_lembaga_id' => $user_lembaga_id,
                'pu_user_image' => $nama_gambar,
            ];
            // var_dump($personalData);


            $data = $this->AuthModel->updatePersonalData($id_user, $personalData);
            echo json_encode($data);
        }
    }

    public function submit_lembaga()
    {
        if ($this->request->isAJAX()) {
            $user_lembaga_id = $this->request->getPost('user_lembaga_id');
            $lp_kepala = $this->request->getPost('lp_kepala');
            $lp_nip = $this->request->getPost('lp_nip');
            $lp_sekretariat = $this->request->getPost('lp_sekretariat');
            $lp_kode_pos = $this->request->getPost('lp_kode_pos');
            $lp_email = $this->request->getPost('lp_email');
            $id_user = $this->request->getPost('id_user');

            // ambil gambar
            // $file_gambar = $this->request->getFile('fp_user');
            // dd($file_gambar);

            // if ($file_gambar->getError() == 4) {
            //     $nama_gambar = 'assets/dist/img/profile/default.png';
            // } else {
            // // generate nama file
            // $nama_gambar = $file_gambar->getRandomName();

            // pindahkan file ke folder profil
            // $file_gambar->move('data/profil');

            //ambil nama file
            // $nama_gambar = $file_gambar->getName();
        }

        $lembagaData = [
            'lp_kategori' => $user_lembaga_id,
            'lp_kepala' => $lp_kepala,
            'lp_nip' => $lp_nip,
            'lp_sekretariat' => $lp_sekretariat,
            'lp_kode_pos' => $lp_kode_pos,
            'lp_email' => $lp_email,
            'lp_user' => $id_user,
            // 'user_image' => $nama_gambar,
        ];
        // var_dump($lembagaData);


        $data = $this->LembagaModel->submitlembagaData($lembagaData);
        echo json_encode($data);
    }

    public function update_lembaga()
    {
        if ($this->request->isAJAX()) {
            $lp_id = $this->request->getPost('lp_id');
            $user_lembaga_id = $this->request->getPost('user_lembaga_id');
            $lp_kepala = $this->request->getPost('lp_kepala');
            $lp_nip = $this->request->getPost('lp_nip');
            $lp_sekretariat = $this->request->getPost('lp_sekretariat');
            $lp_kode_pos = $this->request->getPost('lp_kode_pos');
            $lp_email = $this->request->getPost('lp_email');
            $id_user = $this->request->getPost('id_user');

            // ambil gambar
            // $file_gambar = $this->request->getFile('fp_user');
            // dd($file_gambar);

            // if ($file_gambar->getError() == 4) {
            //     $nama_gambar = 'assets/dist/img/profile/default.png';
            // } else {
            // // generate nama file
            // $nama_gambar = $file_gambar->getRandomName();

            // pindahkan file ke folder profil
            // $file_gambar->move('data/profil');

            //ambil nama file
            // $nama_gambar = $file_gambar->getName();
        }

        $lembagaData = [
            'lp_id' => $lp_id,
            'lp_kategori' => $user_lembaga_id,
            'lp_kepala' => $lp_kepala,
            'lp_nip' => $lp_nip,
            'lp_sekretariat' => $lp_sekretariat,
            'lp_kode_pos' => $lp_kode_pos,
            'lp_email' => $lp_email,
            'lp_user' => $id_user
            // 'user_image' => $nama_gambar,
        ];
        // var_dump($lembagaData);


        $data = $this->LembagaModel->updatelembagaData($lp_id, $lembagaData);
        echo json_encode($data);
    }

    public function detailDhkp($id_sppt)
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/user'));
        }
        $data = [
            'title' => 'Detail SPPT',
            'Dhkp' => $this->dhkpModel->getDhkp($id_sppt)
        ];
        return view('dhkp/detailDhkp', $data);
    }
    public function create()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/user'));
        }
        // session();
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        return view('pbb/admin/create', $data);
    }
    public function save()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/user'));
        }
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
            return redirect()->to('/admin/create')->withInput();
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

        return redirect()->to('/admin');
    }

    public function delete($id_user)
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/user'));
        }
        // cari gambar berdasarkan id
        $user = $this->userModel->find($id_user);

        //cek jika file gambarnya default.png
        if ($user['foto'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $user['foto']);
        }

        $this->userModel->delete($id_user);

        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/admin');
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

        $fileFoto = $this->request->getFile('user_image');

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
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level'),
            'user_image' => $namaFoto
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/pbb/admin');
    }

    public function setting_web()
    {
        $prof = profilAdmin();
        // dd($prof);
        $kecamatan = $this->wilayahModel->getKec();
        $data = [
            'title' => 'Setting Web',
            'myNama' => $prof->pu_fullname,
            'myKec' => $prof->pu_kode_kec,
            'kecamatan' => $kecamatan,

        ];
        return view('pbb/admin/setting_web', $data);
    }

    public function get_count_desa($kode_kec)
    {
        $data = $this->wilayahModel->getDesa($kode_kec);

        echo json_encode($data);
    }

    public function get_hitung()
    {
        // dd($data);
        $data = [
            'jumlahSppt' => $this->dhkpModel22->jumlah_semua()->jml,
            'jumlahTotal' => $this->dhkpModel22->jumlah_total()->jumlah_total,
            'jumlahLunas' => $this->dhkpModel22->jumlahLunas()->jumlahLunas,
            'jumlahTotalLunas' => $this->dhkpModel22->jumlahTotalLunas()->jumlahTotalLunas,
            'jumlahBelumLunas' => $this->dhkpModel22->jumlahBelumLunas()->jumlahBelumLunas,
            'jumlahTotalBelumLunas' => $this->dhkpModel22->jumlahTotalBelumLunas()->jumlahTotalBelumLunas,
            'jumlahBermasalah' => $this->dhkpModel22->jumlahBermasalah()->jumlahBermasalah,
            'jumlahTotalBermasalah' => $this->dhkpModel22->jumlahTotalBermasalah()->jumlahTotalBermasalah,
        ];

        // var_dump($data);
        echo json_encode($data);
    }

    public function getDataRtRwDusun()
    {
        $dataSls = $this->wilayahModel->getDataRtRwDusun();
        return $dataSls;
    }
}
