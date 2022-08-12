<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pbb\DhkpModel;
use App\Models\DusunModel;
use App\Models\RwModel;
use App\Models\RtModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Request;

class Dhkp extends BaseController
{
    protected $dhkpModel;
    public function __construct()
    {
        $this->dhkpModel = new DhkpModel();
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
    }

    public function index()
    {
        // if (session()->get('level') > 1) {
        //     return redirect()->to(base_url('pbb/pages/home'));
        // }
        $noHalaman = $this->request->getVar('page_paging') ? $this->request->getVar('page_paging') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $dhkp = $this->dhkpModel->search($keyword);
        } else {
            $dhkp = $this->dhkpModel;
        }
        $data = [
            'title' => 'DHKP',
            'dhkp' => $dhkp->paginate(10, 'paging'),
            'pager' => $this->dhkpModel->pager,
            'noHalaman' => $noHalaman
        ];
        return view('pbb/dhkp/index', $data);
    }

    public function detail($id)
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        $data = [
            'title' => 'Detail dhkp',
            'dhkp' => $this->dhkpModel->getDhkp($id)
        ];

        // jika dhkp tidak ada di tabel
        if (empty($data['dhkp'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID dhkp ' . $id . ' tidak ditemukan.');
        }

        return view('pbb/dhkp/detail', $data);
    }

    function formtambahdhkp()
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('pbb/dhkp/modalformtambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function add()
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        $data = [
            'title' => 'Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        return view('pbb/dhkp/add', $data);
    }

    public function simpandatadhkp()
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        if ($this->request->isAJAX()) {
            $this->dhkpModel->insert([
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
            ]);
            $msg = [
                'success' => 'DHKP baru berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }

    function hapusdhkp()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $this->dhkpModel->delete($id);

            $msg = [
                'success' => 'Data DHKP berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataDusun()
    {
        if ($this->request->isAJAX()) {
            $caridata = $this->request->getGet('search');

            $dataDusun = $this->db->table('tbl_dusun')->LIKE('no_dusun', $caridata)->get();

            if ($dataDusun->getNumRows() > 0) {
                $list = [];
                $key = 0;
                foreach ($dataDusun->getResultArray() as $row) :
                    $list[$key]['id'] = $row['id'];
                    $list[$key]['text'] = $row['no_dusun'];
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

            $dataRw = $this->db->table('tbl_rw')->where('id_dusun', $dusun)->get();

            $isidata = "";

            foreach ($dataRw->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['id'] . '">' . $row['no_rw'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }
    public function pembayaran()
    {
        if (session()->get('level') > 1) {
            return redirect()->to(base_url('pbb/pages/home'));
        }
        $data = [
            'title' => 'Pembayaran',

        ];
        return view('pbb/dhkp/pembayaran', $data);
    }

    public function terutang()
    {
        // dd($data);
        $data = [
            'title' => 'PBB 2020 Terutang',
        ];
        return view('pbb/dhkp/terutang', $data);
    }


    public function pbbterhutang()
    {
        $user = session()->get('jabatan');

        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->dhkpModel->table('pbb_dhkp')
                    ->where('ket', '>1')
                    ->where('dusun', $user)
                    ->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp/pbbterhutang', $data)
            ];

            echo json_encode($msg);
        }
    }
}
