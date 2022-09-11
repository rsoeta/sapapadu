<?php

namespace App\Controllers;

use App\Models\Pbb\AuthModel;
use App\Models\Pbb\DetailTransModel;
use App\Controllers\BaseController;
use App\Models\Pbb\DhkpModel22;
use App\Models\DusunModel;
use App\Models\Pbb\TrxModel22;
use App\Models\WilayahModel;


class Auth extends BaseController
{
    protected $authModel;
    protected $det_trans;
    public function __construct()
    {
        $this->authModel = new AuthModel();
        $this->det_trans = new DetailTransModel();
        $this->trans = new TrxModel22();
        $this->DhkpModel22 = new DhkpModel22();
    }
    public function index()
    {
        // ini_set('max_execution_time', 0);
        // ini_set('memory_limit', '2048M');

        $dhkpModel22 = new DhkpModel22();

        $targetPerDusun = $this->DhkpModel22->getDataRekDus()->getResultArray();
        $setoranPerDusun = $this->DhkpModel22->getDataRekDus()->getResultArray();
        $setoranPerRw = $this->DhkpModel22->getDataRekRw()->getResultArray();
        $targetPerRw = $this->DhkpModel22->getDataRekRw()->getResultArray();

        $dataPerDusun = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_dusun.no_dusun AS dusun')
            ->join('tbl_dusun', 'pbb_dhkp22.dusun = tbl_dusun.no_dusun')
            ->groupBy('pbb_dhkp22.dusun')
            ->get();

        $dataPerRw = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_rw.no_rw AS rw')
            ->join('tbl_rw', 'pbb_dhkp22.rw = tbl_rw.no_rw')
            ->groupBy('pbb_dhkp22.rw')
            ->get();

        $setorPerDusun = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_dusun.no_dusun AS dusun')
            ->join('tbl_dusun', 'pbb_dhkp22.dusun = tbl_dusun.no_dusun')
            ->where('pbb_dhkp22.ket', 0)
            ->groupBy('pbb_dhkp22.dusun')
            ->get();

        $setorPerRw = $dhkpModel22->select('SUM(pbb_dhkp22.pajak) AS jumlah, tbl_rw.no_rw AS rw')
            ->join('tbl_rw', 'pbb_dhkp22.rw = tbl_rw.no_rw')
            ->where('pbb_dhkp22.ket', 0)
            ->groupBy('pbb_dhkp22.rw')
            ->get();

        // $data = [
        //     'title' => 'Home',
        //     'targetPerDusun' => $targetPerDusun,
        //     'setoranPerDusun' => $setoranPerDusun,
        //     'dataPerDusun' => $dataPerDusun,
        //     'dataPerRw' => $dataPerRw,
        //     'setorPerDusun' => $setorPerDusun,
        //     'setorPerRw' => $setorPerRw,
        //     'targetPerRw' => $targetPerRw,
        //     'setoranPerRw' => $setoranPerRw,
        //     // 'jumlahTotalBelumLunasPerDusun' => $this->DhkpModel22->jumlahTotalBelumLunasPerDusun()->getResultArray(),
        // ];

        // var_dump($data['jumlahTotalBelumLunasPerDusun']);
        // die;

        return view('pbb/index');
    }

    public function cari()
    {

        if ($this->request->isAJAX()) {

            $model = new DhkpModel22();
            $nop = $this->request->getPost('nop');
            $nama_wp = $this->request->getPost('nama_wp');

            $data = [
                'tampildata' => $model->getLunas(),
                'ket' => 0
            ];
            $db = \Config\Database::connect();
            $cek = $db->table("pbb_dhkp22");
            // $cek->select('*');
            // $cek->join('pbb_detailtrans22', 'pbb_detailtrans22.nop = pbb_dhkp22.nop');
            // $cek->join('pbb_transaksi22', 'pbb_transaksi22.tr_faktur = pbb_detailtrans22.dettr_faktur');
            $cek = $cek->where(array(
                "nop" => $nop,
                "nama_wp" => $nama_wp,
            ));

            // select all data
            $data = $cek->get()->getRowArray();
            // var_dump($data);
            // die;

            if ($nop == "" || $nama_wp == "") {
                $msg = [
                    'title' => 'Home',
                    'error' => 'Silahkan isi data terlebih dahulu!'
                ];
            } else if ($data == null) {
                $msg = [
                    'title' => 'Home',
                    'null' => 'Mohon Maaf, data tidak ditemukan!'
                ];
            } else {
                $msg  = [
                    'title' => 'Home',
                    'data' => view('pbb/hasil_pencarian', $data)
                ];
            }

            echo json_encode($msg);
        }
    }

    public function login()
    {

        $data = [];

        if ($this->request->getPost()) {

            // var_dump($this->request->getvar());
            // $nik = $this->request->getVar('nik');

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[pu_email,pu_password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email atau Password tidak sesuai",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                $session = session();
                $session->setFlashdata('message', 'User atau Password tidak sesuai!');
                return view('pbb/auth/login', [
                    "validation" => $this->validator,
                    "title" => 'Sign In',
                ]);
            } else {

                $model = new AuthModel();

                $user = $model->where('pu_email', $this->request->getVar('email'))->first();
                // dd($user);
                $this->setUserSession($user);


                // dd($this->setUserSession($user));
                // Redirecting to dashboard after login
                if ($user['pu_status'] !== 1) {
                    $session = session();
                    $session->setFlashdata('message', 'User Non-Aktif, Silakan hubungi Admin!');
                    return redirect()->to('login');
                }
            }
        }
        // echo 'test';
        $data = [
            'title' => 'Sign In',
        ];

        return view('pbb/auth/login', $data);
    }


    private function setUserSession($user)
    {
        $data = [
            'pu_id' => $user['pu_id'],
            'pu_nik' => $user['pu_nik'],
            'pu_email' => $user['pu_email'],
            'pu_username' => $user['pu_username'],
            'pu_fullname' => $user['pu_fullname'],
            'pu_user_image' => $user['pu_user_image'],
            'pu_level' => $user['pu_level'],
            'pu_jabatan' => $user['pu_jabatan'],
            'pu_status' => $user['pu_status'],
            'pu_role_id' => $user['pu_role_id'],
            'pu_kode_desa' => $user['pu_kode_desa'],
            'pu_kode_kec' => $user['pu_kode_kec'],
            'pu_kode_kab' => $user['pu_kode_kab'],
            'pu_kode_prov' => $user['pu_kode_prov'],
            'logPbb' => true,
        ];

        session()->set($data);
        return true;
    }


    public function register()
    {
        // $data = [];\
        $kode_kec = profilAdmin()->pu_kode_kec;
        $this->WilayahModel = new WilayahModel();

        $data = [
            'title' => 'Registration',
            'desa' => $this->WilayahModel->orderBy('name', 'asc')->where('district_id', $kode_kec)->findAll(),

        ];

        if ($this->request->getPost()) {
            // let's do the validation here
            $rules = [
                'pu_role_id' => [
                    'label' => 'Jabatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'pu_kode_desa' => [
                    'label' => 'Nama Desa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'pu_fullname' => [
                    'label' => 'Nama Lengkap',
                    'rules' => 'required|min_length[3]|max_length[100]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                    ]
                ],
                'pu_nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|numeric|min_length[16]|max_length[16]|is_unique[pbb_users.pu_nik,pu_nik,{pu_id}]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'numeric' => '{field} harus berupa angka',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'pu_email' => [
                    'label' => 'Email',
                    'rules' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[pbb_users.pu_email,pu_email,{pu_id}]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                        'valid_email' => '{field} tidak valid',
                        'is_unique' => '{field} sudah terdaftar',

                    ]
                ],
                'pu_password' => [
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]|max_length[255]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} terlalu pendek',
                        'max_length' => '{field} terlalu panjang',
                    ]
                ],
                'pass_confirm' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'matches[pu_password]',
                    'errors' => [
                        'matches' => '{field} tidak sama'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                return view('pbb/auth/register', [
                    "validation" => $this->validator,
                    'title' => 'Register',
                    'desa' => $this->WilayahModel->orderBy('name', 'asc')->where('district_id', $kode_kec)->findAll(),
                ]);
            } else {
                //strore the user to database
                $model = new AuthModel();

                $data = [
                    'pu_role_id' => $this->request->getPost('pu_role_id'),
                    'pu_kode_desa' => $this->request->getPost('pu_kode_desa'),
                    'pu_kode_kec' => $kode_kec,
                    'pu_kode_kab' => profilAdmin()->pu_kode_kab,
                    'pu_kode_prov' => profilAdmin()->pu_kode_prov,
                    'pu_level' => $this->request->getPost('pu_level'),
                    'pu_fullname' => $this->request->getPost('pu_fullname'),
                    'pu_nik' => $this->request->getPost('pu_nik'),
                    'pu_email' => $this->request->getPost('pu_email'),
                    'pu_password' => $this->request->getPost('pu_password'),
                    'pu_status' => 0,
                    'pu_created_at' => date('Y-m-d H:i:s'),
                ];
                // dd($data);
                $model->save($data);
                $session = session();
                $session->setFlashdata('success', 'Registrasi Berhasil, silahkan hubungi Admin untuk aktivasi');
                return redirect()->to('/login');
            }
        }

        return view('pbb/auth/register', $data);
    }


    public function logout()
    {
        session()->remove('logPbb');
        session()->remove('pu_nik');
        session()->remove('pu_email');
        session()->remove('pu_fullname');
        session()->remove('pu_level');
        session()->remove('pu_user_image');
        session()->destroy();
        session()->setFlashdata('info', 'Logout sukses..');
        return redirect()->to(base_url());
    }
}
