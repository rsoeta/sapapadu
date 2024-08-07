<?php

namespace App\Controllers;

use App\Models\Pbb\DhkpModel;
use App\Models\DusunModel;
use App\Models\Pbb\DhkpModel21;
use App\Models\Pbb\DhkpModel22;
use App\Models\Pbb\UserModel;
use App\Models\Pbb\TransactionModel21;
use App\Models\Pbb\TrxModel22;
use DateTime;

class Pages extends BaseController
{
    protected $dhkpModel;
    protected $userModel;
    public function __construct()
    {
        $this->dhkpModel = new DhkpModel();
        $this->DhkpModel22 = new DhkpModel22();
        $this->userModel = new UserModel();
        $this->trans = new TransactionModel21();
        $this->TrxModel22 = new TrxModel22();
    }
    public function register()
    {
        $data = [
            'title' => 'Register'
        ];
        if ($this->request->getMethod() == 'post') {
            // buat validasi disini
            $rules = [
                'nama_user'         => 'required|min_length[3]|max_length[50]',
                'email'             => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
                'hp'                => 'required|min_length[10]|max_length[15]|is_unique[user.hp]',
                'password'          => 'required|min_length[8]|max_length[255]',
                'password_confirm'  => 'matches[password]',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // store the user in our database
                $model = new UserModel();

                $newData = [
                    'nama_user'     => $this->request->getVar('nama_user'),
                    'email'         => $this->request->getVar('email'),
                    'hp'            => $this->request->getVar('hp'),
                    'password'      => $this->request->getVar('password'),
                ];
                $model->save($newData);
                $session = session();
                $session->setFlashdata('Success', 'Successful Registration');
                return redirect()->to('login');
            }
        }

        return view('pbb/pages/register', $data);
    }

    public function login()
    {

        $data = [
            'title' => 'Login'
        ];

        return view('pbb/pages/login', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
        ];
        // $this->cachePage(60); // 60 seconds
        return view('pbb/pages/index2', $data);
    }

    public function index2()
    {
        // $diagramKecamatan = $this->DhkpModel22->getDiagramKecamatan();
        // $setoranPerDesa = $this->DhkpModel22->setoranPerDesa();
        $setoranPerDusun = $this->DhkpModel22->setoranPerDusun();
        $setoranPerRw = $this->DhkpModel22->setoranPerRw();
        $setoranPerRt = $this->DhkpModel22->setoranPerRt();
        $timelineChart = $this->TrxModel22->timelineChart();
        // $getChartKecBulanan = $this->DhkpModel22->getChartKecBulanan();
        // $getChartKecMingguan = $this->DhkpModel22->getChartKecMingguan();
        // dd($getChartKecBulanan);
        // $dataPerDesa = $this->DhkpModel22->jumlahSppt();
        // dd($dataPerDesa);

        // Calculate remaining percentage dusun
        foreach ($setoranPerDusun as $key => $dusunData) {
            $setoranPerDusun[$key]->dusun = sprintf('%03d', $dusunData->dusunNama); // Format dusun as 3-digit number
            $setoranPerDusun[$key]->dataSisaPersentase = 100 - $dusunData->dataPersentase;
        }

        // Calculate remaining percentage rw
        foreach ($setoranPerRw as $key => $rwData) {
            $setoranPerRw[$key]->rw = sprintf('%03d', $rwData->rwNama); // Format dusun as 3-digit number
            $setoranPerRw[$key]->dataSisaPersentase = 100 - $rwData->dataPersentase;
        }

        // Calculate remaining percentage rt
        foreach ($setoranPerRt as $key => $rtData) {
            $setoranPerRt[$key]->rt = sprintf('%03d', $rtData->rtNama); // Format dusun as 3-digit number
            $setoranPerRt[$key]->dataSisaPersentase = 100 - $rtData->dataPersentase;
        }

        // Contoh data setoran
        // $timelineChart = [
        //     ['tr_tgl' => '2023-01-01', 'tr_totalkotor' => 100],
        //     ['tr_tgl' => '2023-02-01', 'tr_totalkotor' => 200],
        //     ['tr_tgl' => '2023-03-01', 'tr_totalkotor' => 150],
        //     ['tr_tgl' => '2023-04-01', 'tr_totalkotor' => 300],
        // ];

        // Dapatkan semua data setoran dari model Anda
        $allData = $this->TrxModel22->timelineChart();

        // Tahun berjalan
        $currentYear = (new DateTime())->format('Y');

        // Filter data untuk tahun berjalan
        $timelineChart = array_filter($allData, function ($item) use ($currentYear) {
            return (new DateTime($item->tr_tgl))->format('Y') == $currentYear;
        });

        $data = [
            'title' => 'Diagram Progres',
            // 'diagramKecamatan' => $diagramKecamatan,
            // 'setoranPerDesa' => $setoranPerDesa,
            'setoranPerDusun' => $setoranPerDusun,
            'setoranPerRw' => $setoranPerRw,
            'setoranPerRt' => $setoranPerRt,
            'timelineChart' => array_values($timelineChart),
            // 'chartKecBulanan' => $getChartKecBulanan,
            // 'chartKecMingguan' => $getChartKecMingguan,
            // 'dataPerDesa' => $dataPerDesa,
        ];
        // dd($data['timelineChart']);

        return view('pbb/pages/index', $data);
    }

    public function home()
    {
        $dhkpModel21 = new DhkpModel21();

        $setoranPerDesa = $this->DhkpModel22->getDataRekDes()->getResultArray();
        $setoranPerDusun = $this->DhkpModel22->getDataRekDus()->getResultArray();
        $setoranPerRw = $this->DhkpModel22->getDataRekRw()->getResultArray();
        $setoranPerRt = $this->DhkpModel22->getDataRekRt()->getResultArray();

        $dataPerDusun = $dhkpModel21->select('SUM(pbb_dhkp21.pajak) AS jumlah, tb_dusun.td_kode_dusun AS dusun')
            ->join('tb_dusun', 'pbb_dhkp21.dusun = tb_dusun.td_kode_dusun')
            ->groupBy('pbb_dhkp21.dusun')
            ->get();

        $dataPerRw = $dhkpModel21->select('SUM(pbb_dhkp21.pajak) AS jumlah, tbl_rw.no_rw AS rw')
            ->join('tbl_rw', 'pbb_dhkp21.rw = tbl_rw.no_rw')
            ->groupBy('pbb_dhkp21.rw')
            ->get();

        $setorPerDusun = $dhkpModel21->select('SUM(pbb_dhkp21.pajak) AS jumlah, tb_dusun.td_kode_dusun AS dusun')
            ->join('tb_dusun', 'pbb_dhkp21.dusun = tb_dusun.td_kode_dusun')
            ->where('pbb_dhkp21.ket', 0)
            ->groupBy('pbb_dhkp21.dusun')
            ->get();

        $setorPerRw = $dhkpModel21->select('SUM(pbb_dhkp21.pajak) AS jumlah, tb_rw.no_rw AS rw')
            ->join('tb_rw', 'pbb_dhkp21.rw = tb_rw.no_rw')
            ->where('pbb_dhkp21.ket', 0)
            ->groupBy('pbb_dhkp21.rw')
            ->get();


        $data = [
            'title' => 'Dashboard',
            'setoranPerDesa' => $setoranPerDesa,
            // 'setoranPerDusun' => $setoranPerDusun,
            // 'setoranPerRw' => $setoranPerRw,
            // 'setoranPerRt' => $setoranPerRt,
            // 'dataPerDusun' => $dataPerDusun,
            // 'dataPerRw' => $dataPerRw,
            // 'setorPerDusun' => $setorPerDusun,
            // 'setorPerRw' => $setorPerRw,
        ];

        // dd($data['setoranPerRw']);
        // die;

        return view('pbb/pages/index2', $data);
    }

    public function user()
    {
        // $user = $this->userModel->findAll();

        $data = [
            'title' => 'Users',
            'user' => $this->userModel->getUser()
        ];
        return view('pbb/admin/index', $data);
    }
    public function detailUser($id_user)
    {
        $data = [
            'title' => 'Detail User',
            'user' => $this->userModel->getUser($id_user)
        ];

        // jika user tidak ada di tabel
        if (empty($data['User'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID User ' . $id_user . 'tidak ditemukan.');
        }

        return view('admin/detail', $data);
    }
    public function dhkp()
    {
        $data = [
            'title' => 'DHKP',
            'dhkp' => $this->dhkpModel->getDhkp()
        ];
        return view('dhkp/dhkp', $data);
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
        return view('admin/create', $data);
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
                'rules' => 'required',
                'errors' => [
                    'required' => 'no. hp harus diisi.'
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
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/create')->withInput()->with('validation', $validation);
        }
        $this->userModel->save([
            'nama_user' => $this->request->getVar('nama_user'),
            'hp' => $this->request->getVar('hp'),
            'password' => $this->request->getVar('password'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/admin/user');
    }
}
