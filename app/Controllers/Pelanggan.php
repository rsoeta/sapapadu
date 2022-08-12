<?php

namespace App\Controllers;

use App\Models\Pbb\DhkpModel;
use App\Models\Pbb\DhkpModel21;
use App\Models\Pbb\PelangganModel;
use App\Models\DusunModel;
use App\Models\RwModel;
use App\Models\RtModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

class Pelanggan extends BaseController
{
    protected $dhkpModel21;
    public function __construct()
    {
        $this->dhkpModel = new DhkpModel();
        $this->dhkpModel21 = new DhkpModel21();
        $this->pelanggan = new PelangganModel();
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
        helper('form');
    }

    public function index()
    {
        // dd($data);
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'Data Pelanggan Wajib Pajak PBB',
        ];
        return view('pbb/pelanggan/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->pelanggan->findAll()
            ];

            $msg = [
                'data' => view('pbb/pelanggan/pelanggan', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function detail($id)
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/index'));
        }
        $data = [
            'title' => 'Detail dhkp',
            'dhkp' => $this->dhkpModel->getDhkp($id)
        ];

        // jika dhkp tidak ada di tabel
        if (empty($data['dhkp'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID dhkp ' . $id . ' tidak ditemukan.');
        }

        return view('dhkp21/detail', $data);
    }

    public function formtambah()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url());
        }
        if ($this->request->isAJAX()) {
            $data = [
                'aksi' => $this->request->getPost('aksi')
            ];
            $msg = [
                'data' => view('pbb/pelanggan/modalformtambah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $nik = $this->request->getVar('nik');
            $nama_pelanggan = $this->request->getVar('nama_pelanggan');
            $dusun = $this->request->getVar('dusun');
            $rw = $this->request->getVar('rw');
            $rt = $this->request->getVar('rt');

            $validation = \Config\Services::validation();

            $doValid = $this->validate([

                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'nama_pelanggan' => [
                    'label' => 'Nama Pelanggan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorNik' => $validation->getError('nik'),
                        'errorNamapelanggan' => $validation->getError('nama_pelanggan')
                    ]
                ];
            } else {
                $simpandata = [];
                // var_dump($simpandata);
                $this->pelanggan->insert([
                    'nik' => $nik,
                    'nama_pelanggan' => $nama_pelanggan,
                    'id_dusun' => $dusun,
                    'id_rw' => $rw,
                    'id_rt' => $rt,
                ]);

                $msg = [
                    'sukses' => 'Data Pelanggan berhasil di simpan!'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_pelanggan = $this->request->getVar('id_pelanggan');

            $row = $this->pelanggan->find($id_pelanggan);

            $data = [
                'id_pelanggan' => $row['id_pelanggan'],
                'nop' => $row['nop'],
                'nama_wp' => $row['nama_wp'],
                'alamat_wp' => $row['alamat_wp'],
                'alamat_op' => $row['alamat_op'],
                'bumi' => $row['bumi'],
                'bgn' => $row['bgn'],
                'pajak' => $row['pajak'],
                'nik_wp' => $row['nik_wp'],
                'nama_ktp' => $row['nama_ktp'],
                'dusun' => $row['dusun'],
                'rw' => $row['rw'],
                'rt' => $row['rt'],
                'ket' => $row['ket']
            ];

            $msg = [
                'sukses' => view('pbb/dhkp21/modaledit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'nop' => $this->request->getVar('nop'),
                'nama_wp' => $this->request->getVar('nama_wp'),
                'alamat_wp' => $this->request->getVar('alamat_wp'),
                'alamat_op' => $this->request->getVar('alamat_op'),
                'bumi' => $this->request->getVar('bumi'),
                'bgn' => $this->request->getVar('bgn'),
                'pajak' => $this->request->getVar('pajak'),
                'nik_wp' => $this->request->getVar('nik_wp'),
                'nama_ktp' => $this->request->getVar('nama_ktp'),
                'dusun' => $this->request->getVar('dusun'),
                'rw' => $this->request->getVar('rw'),
                'rt' => $this->request->getVar('rt'),
                'ket' => $this->request->getVar('ket')
            ];
            // $dhkpModel21 = new DhkpModel21();

            $id = $this->request->getVar('id');

            $this->pelanggan->update($id, $simpandata);

            $msg = [
                'sukses' => 'Data Pelanggan berhasil di update!'
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $this->pelanggan->delete($id);

            $msg = [
                'sukses' => 'Data Pelanggan berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataDusun()
    {
        if ($this->request->isAJAX()) {
            $caridata = $this->request->getGet('search');

            $dataDusun = $this->dusun->table('tbl_dusun')->LIKE('nama_kadus', $caridata)->get();

            if ($dataDusun->getNumRows() > 0) {

                $list = [];
                $key = 0;
                foreach ($dataDusun->getResultArray() as $row) :

                    $list[$key]['id'] = $row['no_dusun'];
                    $list[$key]['text'] = $row['nama_kadus'];
                    $key++;

                endforeach;

                echo json_encode($list);
            }
        }
    }

    public function ambilDataRw()
    {
        if ($this->request->isAJAX()) {
            $dusun = $this->request->getVar('dusun');

            $dataRw = $this->rw->table('tbl_rw')->where('id_dusun', $dusun)->get();

            $isidata = "";

            foreach ($dataRw->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['no_rw'] . '">' . $row['nama_rw'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];

            echo json_encode($msg);
        }
    }

    public function ambilDataRt()
    {
        if ($this->request->isAJAX()) {
            $rw = $this->request->getVar('rw');

            $dataRt = $this->rt->table('tbl_rt')->where('id_rw', $rw)->get();

            $isidata = "";

            foreach ($dataRt->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['id_rt'] . '">' . $row['nama_rt'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];

            echo json_encode($msg);
        }
    }

    public function pbblunas()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel21 = new DhkpModel21();
            $data = [
                'tampildata' => $this->dhkpModel21
                    ->where('ket', '1')
                    ->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp21/pbblunas', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function terhutang()
    {
        // dd($data);
        $data = [
            'title' => 'PBB 2021 Terutang',
        ];
        return view('pbb/dhkp21/terhutang', $data);
    }

    public function pbbterhutang()
    {
        if ($this->request->isAJAX()) {
            $dhkpModel21 = new DhkpModel21();
            $data = [
                'tampildata' => $this->dhkpModel21
                    ->where('ket', '0')
                    ->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp21/pbbterhutang', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function cari()
    {
        $dhkpModel = new DhkpModel();
        $cari = $this->request->getGet('cari');
        $data = $dhkpModel->where('nop', $cari)->findAll();

        // dd($data);

        return view('pbb/dhkp21/create', compact('data'));
    }

    public function getUsers()
    {

        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $data = array();

        if (isset($postData['search'])) {

            $search = $postData['search'];

            // Fetch record
            $users = new DhkpModel();
            // $level_id = session()->get('level_id');
            $userlist = $users->select('nama_wp,alamat_wp,nop')
                // ->where('agen_id', $level_id)
                ->like('nop', $search)
                ->orderBy('nop')
                ->findAll(5);
            foreach ($userlist as $user) {
                $data[] = array(
                    "value" => $user['nama_wp'],
                    "value2" => $user['alamat_wp'],
                    "label" => $user['nop'],
                );
            }
        }

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }

    public function add()
    {
        $data = [
            'title' => 'Form. Tambah Data Pelanggan',
            'validation' => \Config\Services::validation()
        ];
        return view('pbb/pelanggan/add', $data);
    }

    public function ambilDataPelanggan()
    {
        if ($this->request->isAJAX()) {
            $caridata = $this->request->getGet('search');

            $dataPelanggan = $this->pelanggan->table('pbb_pelanggan')->LIKE('nama_pelanggan', $caridata)->get();

            if ($dataPelanggan->getNumRows() > 0) {

                $list = [];
                $key = 0;
                foreach ($dataPelanggan->getResultArray() as $row) :

                    $list[$key]['id'] = $row['id_pelanggan'];
                    $list[$key]['text'] = $row['nama_pelanggan'];
                    $key++;

                endforeach;

                echo json_encode($list);
            }
        }
    }
}
