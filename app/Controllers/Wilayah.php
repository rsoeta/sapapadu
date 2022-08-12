<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\DusunModel;
use App\Models\RwModel;
use App\Models\RtModel;

class Wilayah extends BaseController
{
    public function __construct()
    {
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
    }

    public function datadusun()
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        $tombolCari = $this->request->getpost('tomboldusun');
        if (isset($tombolCari)) {
            $cari = $this->request->getpost('caridusun');
            session()->set('caridusun', $cari);
            redirect()->to('pbb/wilayah/datadusun');
        } else {
            $cari = session()->get('caridusun');
        }
        $datadusun = $cari ? $this->dusun->cariData($cari) : $this->dusun;
        $noHalaman = $this->request->getVar('page_paging') ? $this->request->getVar('page_paging') : 1;
        $data = [
            'title' => 'Wilayah Dusun',
            // 'dusun' => $this->dusunModel->getDusun()
            'datadusun' => $datadusun->paginate(10, 'paging'),
            'pager' => $this->dusun->pager,
            'noHalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('pbb/wilayah/datadusun', $data);
    }

    public function datarw()
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        $tombolCari = $this->request->getpost('tombolrw');
        if (isset($tombolCari)) {
            $cari = $this->request->getpost('carirw');
            session()->set('carirw', $cari);
            redirect()->to('pbb/wilayah/datarw');
        } else {
            $cari = session()->get('carirw');
        }
        $datarw = $cari ? $this->rw->cariData($cari) : $this->rw;

        $noHalaman = $this->request->getVar('page_paging') ? $this->request->getVar('page_paging') : 1;
        $data = [
            'title' => 'Wilayah RW',
            // 'rw' => $this->rwModel->getrw()
            'datarw' => $datarw->paginate(10, 'paging'),
            'pager' => $this->rw->pager,
            'noHalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('pbb/wilayah/datarw', $data);
    }

    public function datart()
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        $tombolCari = $this->request->getpost('tombolrt');
        if (isset($tombolCari)) {
            $cari = $this->request->getpost('carirt');
            session()->set('carirt', $cari);
            redirect()->to('pbb/wilayah/datart');
        } else {
            $cari = session()->get('carirt');
        }
        $datart = $cari ? $this->rt->cariData($cari) : $this->rt;

        $noHalaman = $this->request->getVar('page_paging') ? $this->request->getVar('page_paging') : 1;
        $data = [
            'title' => 'Wilayah RT',
            // 'rt' => $this->rtModel->getrt()
            'datart' => $datart->paginate(10, 'paging'),
            'pager' => $this->rt->pager,
            'noHalaman' => $noHalaman,
            'cari' => $cari
        ];
        return view('pbb/wilayah/datart', $data);
    }

    function formtambahdusun()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $data = [
                'aksi' => $this->request->getPost('aksi')
            ];
            $msg = [
                'data' => view('pbb/wilayah/modalformtambah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    function formTambahRw()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $data = [
                'aksi' => $this->request->getPost('aksi')
            ];
            $msg = [
                'data' => view('pbb/wilayah/modalformtambahrw', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    function formTambahrt()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $data = [
                'aksi' => $this->request->getPost('aksi')
            ];
            $msg = [
                'data' => view('pbb/wilayah/modalformtambahrt', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandataDusun()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $kode_desa = detailUser()->pu_kode_desa;
            $this->dusun->insert([
                'td_kode_desa' => $kode_desa,
                'td_kode_dusun' => $this->request->getVar('no_dusun'),
                'td_nama_dusun' => $this->request->getVar('nama_dusun'),
                'td_kadus_nama' => $this->request->getVar('nama_kadus'),
                'td_kadus_alamat' => $this->request->getVar('alamat_kadus'),
                'td_kadus_nope' => $this->request->getVar('no_hp_kadus'),
                'td_kadus_nik' => $this->request->getVar('nik_kadus'),
            ]);
            $msg = [
                'success' => 'Data Dusun baru berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatarw()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $this->rw->insert([
                'id_dusun' => $this->request->getVar('no_dusun'),
                'no_rw' => $this->request->getVar('no_rw'),
                'nama_rw' => $this->request->getVar('nama_rw')
            ]);
            $msg = [
                'success' => 'Data RW baru berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatart()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $this->rt->insert([
                'id_dusun' => $this->request->getVar('no_dusun'),
                'id_rw' => $this->request->getVar('no_rw'),
                'id_rt' => $this->request->getVar('no_rt'),
                'nama_rt' => $this->request->getVar('nama_rt')
            ]);
            $msg = [
                'success' => 'Data RT baru berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapusdusun()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->dusun->delete($id);

            $msg = [
                'success' => 'Data Dusun berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function hapusrw()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->rw->delete($id);

            $msg = [
                'success' => 'Data RW berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function hapusrt()
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->rt->delete($id);

            $msg = [
                'success' => 'Data RT berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function detail($id_user)
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->getdusun($id_user)
        ];

        // jika user tidak ada di tabel
        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID User ' . $id_user . ' tidak ditemukan.');
        }

        return view('dusun/detail', $data);
    }

    public function detailDhkp($id_sppt)
    {
        if (detailUser()->pu_role_id > 2) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Detail SPPT',
            'Dhkp' => $this->dhkpModel->getDhkp($id_sppt)
        ];
        return view('dhkp/detailDhkp', $data);
    }


    public function create()
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        // session();
        $data = [
            'title' => 'Form Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/create', $data);
    }
    public function save()
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
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
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
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

    public function edit($id_user)
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        $data = [
            'title' => 'Form Ubah Data',
            'validation' => \Config\Services::validation(),
            'user' => $this->userModel->getUser($id_user)
        ];
        return view('admin/edit', $data);
    }
    public function update($id_user)
    {
        if (detailUser()->pu_role_id > 1) {
            return redirect()->to(base_url());
        }
        // cek duplikat
        //  $userlama = $this->userModel->getUser($this->request->getVar('id_user'));
        //  if($userlama['nama_user']==$this->request->getVar('nama_user')){
        //      $rule_namauser = 'required';
        //  } else {
        //      $rule_namauser='required|is_unique[admin.nama]';
        //  }

        if (!$this->validate([
            'nama_user' => [
                // 'rules' => $rule_namauser,
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
            return redirect()->to('/admin/edit/' . $this->request->getVar('id_user'))->withInput();
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

        return redirect()->to('/admin');
    }

    function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_rt') {
                $RtModel = new RtModel();

                $Rtdata = $RtModel->where('id_rw', $this->request->getVar('no_rw'))->findAll();

                echo json_encode($Rtdata);
            }
        }
    }
}
