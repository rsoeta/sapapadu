<?php

namespace App\Controllers;

use App\Models\Pbb\DetailTransModel;
use App\Models\Pbb\DhkpModel21;
use App\Models\Pbb\DhkpModel22;
use App\Models\Pbb\PelangganModel;
use App\Models\Pbb\KetBayarModel;
use App\Models\Pbb\PengajuanModel;
use App\Models\DesaModel;
use App\Models\DusunModel;
use App\Models\RwModel;
use App\Models\RtModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\IncomingRequest;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @property IncomingRequest $request
 */

class Dhkp22 extends BaseController
{
    protected $dhkpModel22;
    public function __construct()
    {
        $this->DetailTransModel = new DetailTransModel();
        $this->dhkpModel21 = new DhkpModel21();
        $this->dhkpModel22 = new DhkpModel22();
        $this->pelanggan = new PelangganModel();
        $this->KetBayarModel = new KetBayarModel();
        $this->PengajuanModel = new PengajuanModel();
        $this->DesaModel = new DesaModel();
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
        helper(['form', 'url', 'date']);
    }

    public function index()
    {
        $pu_level = detailUser()->pu_level;
        $pu_kode_kec = detailUser()->pu_kode_kec;
        $pu_kode_desa = detailUser()->pu_kode_desa;
        $data_dusun = $this->request->getPost('data_dusun');
        $dusun = new DusunModel();
        $dhkpModel22 = new DhkpModel22();
        // dd($data);
        $data = [

            'pu_role_id' => detailUser()->pu_role_id,
            'pu_level' => $pu_level,
            'pu_kode_desa' => $pu_kode_desa,

            'namaApp' => 'KolektorPBB',
            'title' => 'PBB 2022',
            'title_tab' => 'PBB Terutang',
            'data_desa' => $this->DesaModel->where('district_id', $pu_kode_kec)->orderBy('name', 'asc')->findAll(),
            'dusun' => $dusun->where(['td_kode_desa' => $pu_kode_desa])->orderBy('td_kode_dusun', 'asc')->findAll(),
            'rw' => $this->rw->where(['kode_desa' => $pu_kode_desa, 'no_dusun' => $data_dusun])->orderBy('no_rw', 'asc')->distinct()->findAll(),
            'tampildata' => $dhkpModel22->table('pbb_dhkp22')
                ->where('pd_ket', '>=1')
                ->where('dusun', $pu_level)
                ->findAll(),
            'sta_sppt' => $this->KetBayarModel->where('sta_id>', 1)->orderBy('sta_id', 'desc')->findAll(),
            'jumlahSppt' => $this->dhkpModel22->jumlah_semua()->jml,
            'jumlahTotal' => $this->dhkpModel22->jumlah_total()->jumlah_total,
            'jumlahLunas' => $this->dhkpModel22->jumlahLunas()->jumlahLunas,
            'jumlahTotalLunas' => $this->dhkpModel22->jumlahTotalLunas()->jumlahTotalLunas,
            'jumlahBelumLunas' => $this->dhkpModel22->jumlahBelumLunas()->jumlahBelumLunas,
            'jumlahTotalBelumLunas' => $this->dhkpModel22->jumlahTotalBelumLunas()->jumlahTotalBelumLunas,
            'jumlahBermasalah' => $this->dhkpModel22->jumlahBermasalah()->jumlahBermasalah,
            'jumlahTotalBermasalah' => $this->dhkpModel22->jumlahTotalBermasalah()->jumlahTotalBermasalah,
        ];

        // var_dump($data['sta_sppt']);
        // die;
        return view('pbb/dhkp22/index', $data);
    }


    public function data_dhkp22()
    {
        $model = new DhkpModel22();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $filter0 = $this->request->getPost('data_desa');
        $filter1 = $this->request->getPost('data_dusun');
        $filter2 = $this->request->getPost('data_rw');
        $filter3 = $this->request->getPost('data_rt');
        $filter4 = $this->request->getPost('data_ket');
        $filter5 = $this->request->getPost('data_tahun');

        $listing = $model->get_datatables($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);
        $jumlah_semua = $model->jumlah_semua();
        $jumlah_filter = $model->jumlah_filter($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);

        $data = array();
        $no = $_POST['start'];
        $total_order = 0;

        foreach ($listing as $key) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->nama_wp;
            $row[] = $key->nop;
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = number_format($key->bumi);
            $row[] = number_format($key->pajak);
            $row[] = $key->nama_ktp;
            $row[] = $key->dusun;
            $row[] = $key->rw;
            $row[] = $key->rt;
            $row[] = '<span class="badge badge-' . $key->sta_class . '">' . $key->sta_keterangan . '</span>';

            if (!session()->get('level') == 1) {
                $row[] = '';
            } else {
                $row[] = '
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Pilih Aksi
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <li><a class="dropdown-item" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $key->id . "'" . ')"><i class="fa fa-pencil-alt"></i> Edit</a></li>
                    <li><button class="dropdown-item" data-id="' . $key->id . '" data-nama="' . $key->nama_wp . '" id="tmbDelet"><i class="fa fa-trash-alt"></i> Hapus</button></li>
                    </ul>
                </div>
                </div>
                ';
            }
            $total_order = $total_order + floatval($key->pajak);
            $data[] = $row;
        }
        // if($key->ket) == 1 {$lunas}


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $jumlah_semua->jml,
            "recordsFiltered" => $jumlah_filter->jml,
            "data" => $data,
            "total" => number_format($total_order),
        );
        $output[$csrfName] = $csrfHash;
        echo json_encode($output);
    }

    public function data_dhkp22_1()
    {
        $model = new DhkpModel22();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $filter0 = $this->request->getPost('data_desa');
        $filter1 = $this->request->getPost('data_dusun');
        $filter2 = $this->request->getPost('data_rw');
        $filter3 = $this->request->getPost('data_rt');
        $filter4 = '1';
        $filter5 = $this->request->getPost('data_tahun');

        $listing = $model->get_datatables1($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);
        $jumlah_semua = $model->jumlah_semua1();
        $jumlah_filter = $model->jumlah_filter1($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);

        $data = array();
        $no = $_POST['start'];
        $total_order = 0;

        foreach ($listing as $key) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->nama_wp;
            $row[] = $key->nop;
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = number_format($key->bumi);
            $row[] = number_format($key->pajak);
            $total_order = $total_order + floatval($key->pajak);
            $data[] = $row;
        }
        // if($key->ket) == 1 {$lunas}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $jumlah_semua->jml,
            "recordsFiltered" => $jumlah_filter->jml,
            "data" => $data,
            "total" => number_format($total_order),
        );
        $output[$csrfName] = $csrfHash;
        echo json_encode($output);
    }

    public function data_dhkp22_2()
    {
        $model = new DhkpModel22();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $filter0 = $this->request->getPost('data_desa');
        $filter1 = $this->request->getPost('data_dusun');
        $filter2 = $this->request->getPost('data_rw');
        $filter3 = $this->request->getPost('data_rt');
        $filter4 = '2';
        $filter5 = $this->request->getPost('data_tahun');

        $listing = $model->get_datatables2($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);
        $jumlah_semua = $model->jumlah_semua2();
        $jumlah_filter = $model->jumlah_filter2($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);

        $data = array();
        $no = $_POST['start'];
        $total_order = 0;

        foreach ($listing as $key) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->nama_wp;
            $row[] = $key->nop;
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = number_format($key->bumi);
            $row[] = number_format($key->pajak);
            $total_order = $total_order + floatval($key->pajak);
            $data[] = $row;
        }
        // if($key->ket) == 1 {$lunas}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $jumlah_semua->jml,
            "recordsFiltered" => $jumlah_filter->jml,
            "data" => $data,
            "total" => number_format($total_order),
        );
        $output[$csrfName] = $csrfHash;
        echo json_encode($output);
    }

    public function data_dhkp22_lunas()
    {
        $model = new DhkpModel22();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $filter0 = $this->request->getPost('data_desa');
        $filter1 = $this->request->getPost('data_dusun');
        $filter2 = $this->request->getPost('data_rw');
        $filter3 = $this->request->getPost('data_rt');
        $filter4 = '0';
        $filter5 = $this->request->getPost('data_tahun');

        $listing = $model->get_datatables0($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);
        $jumlah_semua = $model->jumlah_semua0();
        $jumlah_filter = $model->jumlah_filter0($filter0, $filter1, $filter2, $filter3, $filter4, $filter5);

        $data = array();
        $no = $_POST['start'];
        $total_order = 0;

        foreach ($listing as $key) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->nama_wp;
            $row[] = $key->nop;
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = number_format($key->bumi);
            $row[] = number_format($key->pajak);
            $total_order = $total_order + floatval($key->pajak);
            $row[] = $key->updated_at;
            $data[] = $row;
        }
        // if($key->ket) == 1 {$lunas}

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $jumlah_semua->jml,
            "recordsFiltered" => $jumlah_filter->jml,
            "data" => $data,
            "total" => number_format($total_order),
        );
        $output[$csrfName] = $csrfHash;

        echo json_encode($output);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $this->dhkpModel22->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp22/dhkp22', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to('lockscreen');
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

        return view('dhkp22/detail', $data);
    }

    function formTambah()
    {
        $pu_kode_kec = profilAdmin()->pu_kode_kec;
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Form. Tambah Data',
                'pu_role_id' => detailUser()->pu_role_id,
                'data_desa' => $this->DesaModel->where('district_id', $pu_kode_kec)->orderBy('name', 'asc')->findAll(),
                'tampildata' => $this->dhkpModel21->getJoin()->getResultArray(),
                'ket_bayar' => $this->KetBayarModel->findAll(),
                'listAjuan' => $this->PengajuanModel->findAll(),
            ];
            // var_dump('tampildata');
            $msg = [
                'data' => view('pbb/dhkp22/modalAdd', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to('lockscreen');
        }
    }

    public function simpandatadhkp()
    {

        // var_dump($this->request->getVar());
        // die;

        if ($this->request->isAJAX()) {
            $pd_creator = detailUser()->pu_nik;
            $pd_updater = detailUser()->pu_nik;
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nop' => [
                    'label' => 'N.O.P',
                    'rules' => 'required|is_unique[pbb_dhkp22.nop]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nama_wp' => [
                    'label' => 'Nama WP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'alamat_wp' => [
                    'label' => 'Alamat WP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'alamat_op' => [
                    'label' => 'Alamat OP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                // 'bumi' => [
                //     'label' => 'Bumi',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong'
                //     ]
                // ],
                // 'bgn' => [
                //     'label' => 'Bangunan',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong'
                //     ]
                // ],
                'pajak' => [
                    'label' => 'Pajak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                // 'nama_ktp' => [
                //     'label' => 'Nama Pemilik',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong'
                //     ]
                // ],
                'pd_desa' => [
                    'label' => 'Desa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'no_dusun' => [
                    'label' => 'No. Dusun',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'no_rw' => [
                    'label' => 'No. RW',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'no_rt' => [
                    'label' => 'No. RT',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                // 'ket' => [
                //     'label' => 'Keterangan',
                //     'rules' => 'required',
                //     'errors' => [
                //         'required' => '{field} tidak boleh kosong'
                //     ]
                // ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nop' => $validation->getError('nop'),
                        'nama_wp' => $validation->getError('nama_wp'),
                        'alamat_wp' => $validation->getError('alamat_wp'),
                        'alamat_op' => $validation->getError('alamat_op'),
                        // 'bumi' => $validation->getError('bumi'),
                        // 'bgn' => $validation->getError('bgn'),
                        'pajak' => $validation->getError('pajak'),
                        // 'nama_ktp' => $validation->getError('nama_ktp'),
                        'pd_desa' => $validation->getError('pd_desa'),
                        'no_dusun' => $validation->getError('no_dusun'),
                        'no_rw' => $validation->getError('no_rw'),
                        'no_rt' => $validation->getError('no_rt'),
                        'ket' => $validation->getError('ket')
                    ]
                ];
            } else {
                $nama_wp = strtoupper($this->request->getVar('nama_wp'));
                $nama_ktp = strtoupper($this->request->getVar('nama_ktp'));
                if ($nama_ktp == '') {
                    $namaPemilik = $nama_wp;
                } else {
                    $namaPemilik = $nama_ktp;
                }
                $simpandata = [
                    'nop' => $this->request->getVar('nop'),
                    'nama_wp' => strtoupper($this->request->getVar('nama_wp')),
                    'alamat_wp' => strtoupper($this->request->getVar('alamat_wp')),
                    'alamat_op' => strtoupper($this->request->getVar('alamat_op')),
                    'bumi' => $this->request->getVar('bumi'),
                    'bgn' => $this->request->getVar('bgn'),
                    'pajak' => $this->request->getVar('pajak'),
                    'nik_wp' => $this->request->getVar('nik_wp'),
                    'nama_ktp' => $namaPemilik,
                    'pd_prov' => '32',
                    'pd_kab' => '32.05',
                    'pd_kec' => '32.05.33',
                    'pd_desa' => $this->request->getVar('pd_desa'),
                    'dusun' => $this->request->getVar('no_dusun'),
                    'rw' => $this->request->getVar('no_rw'),
                    'rt' => $this->request->getVar('no_rt'),
                    'pd_creator' => $pd_creator,
                    'pd_updater' => $pd_updater,
                    'dhkp_ajuan' => $this->request->getVar('dhkp_ajuan'),
                ];
                // $dhkpModel22 = new DhkpModel22();
                // var_dump($simpandata);
                // die;

                $this->dhkpModel22->save($simpandata);

                $msg = [
                    'sukses' => 'Data berhasil di simpan!'
                ];
            }
            echo json_encode($msg);
        } else {
            return view('lockscreen');
        }
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            // $dhkpModel22 = new DhkpModel22();
            $row = $this->dhkpModel22->find($id);

            $data = [
                'ket_bayar' => $this->KetBayarModel->findAll(),
                'listAjuan' => $this->PengajuanModel->findAll(),
                'id' => $row['id'],
                'nop' => $row['nop'],
                'nama_wp' => $row['nama_wp'],
                'alamat_wp' => $row['alamat_wp'],
                'alamat_op' => $row['alamat_op'],
                'bumi' => $row['bumi'],
                'bgn' => $row['bgn'],
                'pajak' => $row['pajak'],
                'nik_wp' => $row['nik_wp'],
                'nama_ktp' => $row['nama_ktp'],
                'no_dusun' => $row['dusun'],
                'no_rw' => $row['rw'],
                'no_rt' => $row['rt'],
                'ket' => $row['ket'],
                'dhkp_ajuan' => $row['dhkp_ajuan']
            ];

            $msg = [
                'sukses' => view('pbb/dhkp22/modaledit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'nop' => $this->request->getVar('nop'),
                'nama_wp' => strtoupper($this->request->getVar('nama_wp')),
                'alamat_wp' => strtoupper($this->request->getVar('alamat_wp')),
                'alamat_op' => strtoupper($this->request->getVar('alamat_op')),
                'bumi' => $this->request->getVar('bumi'),
                'bgn' => $this->request->getVar('bgn'),
                'pajak' => $this->request->getVar('pajak'),
                'nik_wp' => $this->request->getVar('nik_wp'),
                'nama_ktp' => strtoupper($this->request->getVar('nama_ktp')),
                'dusun' => $this->request->getVar('no_dusun'),
                'rw' => $this->request->getVar('no_rw'),
                'rt' => $this->request->getVar('no_rt'),
                'ket' => $this->request->getVar('ket'),
                'pd_updater' => session()->get('nik'),
                'dhkp_ajuan' => $this->request->getVar('dhkp_ajuan')
            ];
            // $dhkpModel22 = new DhkpModel22();

            $id = $this->request->getVar('id');

            $this->dhkpModel22->update($id, $simpandata);

            $msg = [
                'sukses' => 'Data SPPT berhasil di update!'
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

            // $dhkpModel22 = new DhkpModel22();

            $this->dhkpModel22->delete($id);

            $msg = [
                'sukses' => 'Data SPPT berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataDusun()
    {
        if ($this->request->isAJAX()) {
            $kode_desa = detailUser()->pu_kode_desa;
            $caridata = $this->request->getGet('search');
            if (detailUser()->pu_role_id == 1) {
                $dataDusun = $this->dusun->table('tb_dusun')->like('td_kadus_nama', $caridata)->get();
            } else {
                $dataDusun = $this->dusun->table('tb_dusun')->LIKE('td_kadus_nama', $caridata)->where('td_kode_desa', $kode_desa)->get();
            }

            if ($dataDusun->getNumRows() > 0) {

                $list = [];
                $key = 0;
                foreach ($dataDusun->getResultArray() as $row) :

                    $list[$key]['id'] = $row['td_kode_dusun'];
                    $list[$key]['text'] = $row['td_kadus_nama'];
                    $key++;

                endforeach;

                echo json_encode($list);
            }
        }
    }

    public function ambilDataRw()
    {
        if ($this->request->isAJAX()) {
            $kode_desa = detailUser()->pu_kode_desa;
            $dusun = $this->request->getVar('dusun');

            $dataRw = $this->rw->table('tb_rw')->where(['kode_desa' => $kode_desa, 'no_dusun' => $dusun])->get();

            $isidata = "";

            foreach ($dataRw->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['no_rw'] . '">' . $row['nama_ketua_rw'] . '</option>';
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
            $kode_desa = detailUser()->pu_kode_desa;
            $dusun = $this->request->getVar('dusun');
            $rw = $this->request->getVar('rw');

            $dataRt = $this->rt->table('tb_rw')->where(['kode_desa' => $kode_desa, 'no_rw' => $rw])->get();

            $isidata = "";

            foreach ($dataRt->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['no_rt'] . '">' . $row['nama_ketua_rt'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];

            echo json_encode($msg);
        }
    }

    public function lunas()
    {
        // dd($data);
        $data = [
            'title' => 'PBB 2022 Lunas',
        ];
        return view('pbb/dhkp22/lunas', $data);
    }


    public function pbblunas()
    {
        if ($this->request->isAJAX()) {
            $model = new DhkpModel22();
            $data = [
                'tampildata' => $model->getLunas()
            ];
            // var_dump($data);

            $msg = [
                'data' => view('pbb/dhkp22/pbblunas', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function terutang()
    {
        // dd($data);
        $data = [
            'title_tab' => 'PBB 2022 Terutang',
        ];
        return view('pbb/dhkp22/index', $data);
    }

    public function pbbterhutang()
    {
        $pu_level = detailUser()->pu_level;

        if ($this->request->isAJAX()) {
            $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $dhkpModel22->table('pbb_dhkp22')
                    ->where('pd_ket >=', '1')
                    ->where('dusun', $pu_level)
                    ->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp22/pbbterhutang', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function cari()
    {
        $dhkpModel = new DhkpModel();
        $cari = $this->request->getGet('cari');
        $data = $dhkpModel->where('nop', $cari)->findAll();

        // dd($data);

        return view('pbb/dhkp22/create', compact('data'));
    }

    public function add()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'title' => 'Form. Tambah Data',
                'validation' => \Config\Services::validation()
            ];
            $msg = [];
        }
        return view('pbb/dhkp22/modaltambah', $data);
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

    public function tarikData()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getPost('keyword');
            $data = [
                'keyword' => $keyword
            ];
            $msg = [
                'title' => 'Data PBB Thn 2021',
                'viewmodal' => view('pbb/dhkp22/modalDataTerhutang', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function listPbb2021()
    {
        if ($this->request->isAJAX()) {
            $keywordnop = $this->request->getPost('keywordnop');

            $request = Services::request();
            $model2022 = new DhkpModel22($request);
            if ($request->getMethod(true) == 'POST') {
                $lists = $model2022->get_datatables($keywordnop);
                $data = [];
                $no = $request->getPost("start");
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->nop;
                    $row[] = $list->nama_wp;
                    $row[] = $list->alamat_op;
                    $row[] = number_format($list->pajak, 0, ",", ",");
                    $row[] = $list->ket;
                    $row[] = $list->nama_dusun;
                    $row[] = "<button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"pilihitem('" . $list->nop . "', '" . $list->nama_wp . "')\">Pilih</button>";
                    $data[] = $row;
                }
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => $model2022->count_all($keywordnop),
                    "recordsFiltered" => $model2022->count_filtered($keywordnop),
                    "data" => $data
                ];
                echo json_encode($output);
            }
        }
    }

    public function dataDetail()
    {
        // $nofaktur = "#KDPSL010170001";
        $nofaktur = $this->request->getVar('nofaktur');

        $tempTr = $this->db->table('pbb_dhkp22');
        $queryTampil = $tempTr
            ->select('id, nama_wp, nop, alamat_wp, alamat_op, bumi, bgn, nik_wp, nama_ktp, dusun, rw, rt,pajak, ket, created_at, updated_at')
            // ->join('pbb_dhkp22', 'pbb_temptrans22.nop = pbb_dhkp22.nop')
            // ->where('dettr_faktur', $nofaktur)
            ->orderBy('id', 'desc');

        $data = [
            'datadetail' => $queryTampil->get(),
            'faktur' => $nofaktur
        ];
        // dd($data);

        $msg = [
            'data' => view('pbb/dhkp22/detailtr', $data)
        ];

        echo json_encode($msg);
    }

    function exportBelumLunas()
    {
        $model = new DhkpModel22();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        // $model = new Usulan22Model();
        $filter1 = $this->request->getPost('desa');
        $filter2 = $this->request->getPost('rw');
        $filter3 = $this->request->getPost('rt');
        $filter4 = $this->request->getPost('bansos');

        $listing = $model->get_datatables($filter1, $filter2, $filter3, $filter4);
        $jumlah_semua = $model->jumlah_semua();
        $jumlah_filter = $model->jumlah_filter($filter1, $filter2, $filter3, $filter4);

        $data = array();
        $no = $_POST['start'];
        $total_order = 0;

        foreach ($listing as $key) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $key->nama_wp;
            $row[] = $key->nop;
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = $key->bumi;
            $row[] = $key->pajak;
            $row[] = $key->nama_ktp;
            $row[] = $key->dusun;
            $row[] = $key->rw;
            $row[] = $key->rt;
            $total_order = $total_order + floatval($key->pajak);
            $data[] = $row;
        }
        // if($key->ket) == 1 {$lunas}


        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $jumlah_semua->jml,
            "recordsFiltered" => $jumlah_filter->jml,
            "data" => $data,
            "total" => number_format($total_order),
        );
        $output[$csrfName] = $csrfHash;

        echo json_encode($output);

        // $db      = \Config\Database::connect();
        // $builder = $db->table('pbb_dhkp22');
        // $builder->select('nama_wp, nop, alamat_wp, alamat_op, bumi, bgn, pajak, sta_keterangan, rt, rw, tb_villages.name as desaNama');

        // $builder->join('pbb_stasppt',   'pbb_stasppt.sta_id=pbb_dhkp22.ket');
        // $builder->join('tb_villages',     'tb_villages.id=pbb_dhkp22.pd_desa');
        // $builder->where('ket', '1');
        // $builder->where('rw', $filter2);
        // $builder->where('rt', $filter3);
        // $query = $builder->get();
        // $data = $query->getResultArray();
        // dd($filter2);

        $file_name = 'file-BL-' . date('Ymd_His') . '.xlsx';

        $spreadsheet = new Spreadsheet();

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath('img/logo-garutkab.jpg'); // put your path and image here
        $drawing->setName('logo-garutkab');
        $drawing->setCoordinates('A1');
        $drawing->setWidthAndHeight(500, 500);
        $drawing->setDescription('logo-garutkab');
        // $drawing->setOffsetX(110);
        // $drawing->setRotation(25);
        // $drawing->getShadow()->setVisible(true);
        // $drawing->getShadow()->setDirection(45);

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A5', 'NO');
        $sheet->setCellValue('B5', 'NAMA WP');
        $sheet->setCellValue('C5', 'N.O.P');
        $sheet->setCellValue('D5', 'ALAMAT WP');
        $sheet->setCellValue('E5', 'ALAMAT OP');
        $sheet->setCellValue('F5', 'BUMI');
        $sheet->setCellValue('G5', 'BGN');
        $sheet->setCellValue('H5', 'PAJAK');
        // $sheet->setCellValue('I5', 'KETERANGAN');
        $sheet->setCellValue('J5', 'RT');
        $sheet->setCellValue('K5', 'RW');

        $count = 6;
        $no = 1;
        foreach ($data as $row) {

            $sheet->setCellValue('A' . $count, $no++);
            $sheet->setCellValue('B' . $count, strtoupper($row['nama_wp']));
            $sheet->setCellValueExplicit('C' . $count, $row['nop'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $count, strtoupper($row['alamat_wp']));
            $sheet->setCellValue('E' . $count, strtoupper($row['alamat_op']));
            $sheet->setCellValue('F' . $count, $row['bumi']);
            $sheet->setCellValue('G' . $count, $row['bgn']);
            $sheet->setCellValue('H' . $count, $row['pajak']);
            // $sheet->setCellValue('I' . $count, strtoupper($row['sta_keterangan']));
            $sheet->setCellValue('J' . $count, $row['rt']);
            $sheet->setCellValue('K' . $count, $row['rw']);

            $count++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $count = $count - 1;
        $sheet->getStyle('A5:K' . $count)->applyFromArray($styleArray);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);

        $sheet->setTitle('DATA');

        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));
        flush();

        readfile($file_name);

        exit;
    }

    public function getSppt()
    {
        $model = new DhkpModel21();
        $pu_kode_desa = detailUser()->pu_kode_desa;

        $request = service('request');
        $postData = $request->getPost(); // OR $this->request->getPost();

        $response = array();

        $data = array();

        $builder = $model->table("pbb_dhkp21")->where("pd_desa", $pu_kode_desa);

        $countries = [];

        if (isset($postData['query'])) {

            $query = $postData['query'];

            // Fetch record
            $builder->select('*');
            $builder->like('nop', $query);
            $builder->orLike('nama_wp', $query);
            $query = $builder->get();
            $data = $query->getResult();
        } else {

            // Fetch record
            $builder->select('*');
            $query = $builder->get();
            $data = $query->getResult();
        }

        foreach ($data as $country) {
            $countries[] = array(
                "id" => $country->id,
                "text" => $country->nop . ' - ' . $country->nama_wp,
            );
        }

        $response['data'] = $countries;

        return $this->response->setJSON($response);
    }

    public function initChart()
    {

        $db = \Config\Database::connect();
        $builder = $db->table('pbb_dhkp22');

        $query = $builder->select("COUNT(id) as jumlah_sppt, SUM(pajak) as jumlah_pajak");
        $query = $builder->where("dusun GROUP BY dusun, jumlah_pajak")->get();
        $record = $query->getResult();

        var_dump($record);

        $pbb_dhkp22s = [];

        foreach ($record as $row) {
            $pbb_dhkp22s[] = array(
                'day'   => $row->day,
                'sell' => floatval($row->s)
            );
        }

        $data = [
            'title' => 'Home',
            'namaApp' => 'KolektorPBB',
            'pbb_dhkp22s' => ($pbb_dhkp22s)
        ];
        return view('pbb/index', $data);
    }
}
