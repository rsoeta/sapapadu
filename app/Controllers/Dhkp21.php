<?php

namespace App\Controllers;

use App\Models\Pbb\DhkpModel;
use App\Models\Pbb\DhkpModel21;
use App\Models\Pbb\PelangganModel;
use App\Models\Pbb\KetBayarModel;
use App\Models\Pbb\PengajuanModel;
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

class Dhkp21 extends BaseController
{
    protected $dhkpModel21;
    public function __construct()
    {
        $this->dhkpModel = new DhkpModel();
        $this->dhkpModel21 = new DhkpModel21();
        $this->pelanggan = new PelangganModel();
        $this->KetBayarModel = new KetBayarModel();
        $this->PengajuanModel = new PengajuanModel();
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
        helper('form');
        helper('date');
    }

    public function index()
    {
        $dusun = new DusunModel();
        // dd($data);
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'PBB 2021',
            'dusun' => $dusun->orderBy('no_dusun', 'asc')->findAll(),
            'rw' => $this->rw->noRw(),
        ];

        // var_dump($data['rw']);
        // die;
        return view('pbb/dhkp21/index', $data);
    }


    public function data_dhkp21()
    {
        $model = new DhkpModel21();

        $csrfName = csrf_token();
        $csrfHash = csrf_hash();

        $filter1 = $this->request->getPost('dusun');
        $filter2 = $this->request->getPost('rw');
        $filter3 = $this->request->getPost('rt');
        $filter4 = $this->request->getPost('keterangan');

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
            if ($key->ket == '0') {
                $row[] =
                    '<button type="button" class="btn position-relative">
                ' . $key->nop . '
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                ' . strtoupper($key->sta_keterangan) . '
                <span class="visually-hidden">unread messages</span>
                </span></button>';
            } elseif ($key->ket !== '0') {
                $row[] =
                    '<button type="button" class="btn position-relative">
                ' . $key->nop . '
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    ' . strtoupper($key->sta_keterangan) . '
                    <span class="visually-hidden">unread messages</span>
                </span></button>';
            }
            $row[] = $key->alamat_wp;
            $row[] = $key->alamat_op;
            $row[] = $key->bumi;
            $row[] = $key->bgn;
            $row[] = $key->pajak;
            $row[] = $key->nik_wp;
            $row[] = $key->nama_ktp;
            $row[] = $key->dusun;
            $row[] = $key->rw;
            $row[] = $key->rt;
            $row[] = $key->created_at;
            $row[] = $key->updated_at;


            if (session()->get('level') == 1) {
                $row[] = '
                <a class="dropdown-item" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $key->id . "'" . ')"><i class="fa fa-pencil-alt"></i> Edit</a>';
            } else {
                $row[] = '';
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

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel21 = new DhkpModel21();
            $data = [
                'tampildata' => $this->dhkpModel21->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp21/dhkp21', $data)
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

    function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('pbb/dhkp21/modaltambah')
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf tidak ada halaman yang bisa ditampilkan');
        }
    }

    public function save()
    {
        if (session()->get('level') > 2) {
            return redirect()->to(base_url('pbb/pages/index'));
        }
        $this->dhkpModel21->save([
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

        return redirect()->to('/pbb/dhkp21');
    }

    public function simpandatadhkp()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nop' => [
                    'label' => 'N.O.P',
                    'rules' => 'required|is_unique[pbb_dhkp21.nop]',
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
                'bumi' => [
                    'label' => 'Bumi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'bgn' => [
                    'label' => 'Bangunan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'pajak' => [
                    'label' => 'Pajak',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'nama_ktp' => [
                    'label' => 'Nama Pemilik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'dusun' => [
                    'label' => 'No. Dusun',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'rw' => [
                    'label' => 'No. RW',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'rt' => [
                    'label' => 'No. RT',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'ket' => [
                    'label' => 'Keterangan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nop' => $validation->getError('nop'),
                        'nama_wp' => $validation->getError('nama_wp'),
                        'alamat_wp' => $validation->getError('alamat_wp'),
                        'alamat_op' => $validation->getError('alamat_op'),
                        'bumi' => $validation->getError('bumi'),
                        'bgn' => $validation->getError('bgn'),
                        'pajak' => $validation->getError('pajak'),
                        'nama_ktp' => $validation->getError('nama_ktp'),
                        'dusun' => $validation->getError('dusun'),
                        'rw' => $validation->getError('rw'),
                        'rt' => $validation->getError('rt'),
                        'ket' => $validation->getError('ket')
                    ]
                ];
            } else {
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

                $this->dhkpModel21->insert($simpandata);

                $msg = [
                    'sukses' => 'Data SPPT berhasil di simpan!'
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
            $id = $this->request->getVar('id');

            // $dhkpModel21 = new DhkpModel21();
            $row = $this->dhkpModel21->find($id);

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
                'dusun' => $row['dusun'],
                'rw' => $row['rw'],
                'rt' => $row['rt'],
                'ket' => $row['ket'],
                'dhkp_ajuan' => $row['dhkp_ajuan'],
            ];

            // var_dump($msg);
            // die;
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
                'ket' => $this->request->getVar('ket'),
                'dhkp_ajuan' => $this->request->getVar('dhkp_ajuan')
            ];
            // $dhkpModel21 = new DhkpModel21();

            $id = $this->request->getVar('id');

            $this->dhkpModel21->update($id, $simpandata);

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

            // $dhkpModel21 = new DhkpModel21();

            $this->dhkpModel21->delete($id);

            $msg = [
                'sukses' => 'Data SPPT berhasil dihapus'
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

    public function lunas()
    {
        // dd($data);
        $data = [
            'title' => 'PBB 2021 Lunas',
        ];
        return view('pbb/dhkp21/lunas', $data);
    }


    public function pbblunas()
    {
        if ($this->request->isAJAX()) {
            $model = new DhkpModel21();
            $data = [
                'tampildata' => $model->getLunas()
            ];
            // var_dump($data);

            $msg = [
                'data' => view('pbb/dhkp21/pbblunas', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function terutang()
    {
        // dd($data);
        $data = [
            'title' => 'PBB 2021 Terutang',
        ];
        return view('pbb/dhkp21/terutang', $data);
    }

    public function pbbterhutang()
    {
        $user = session()->get('jabatan');

        if ($this->request->isAJAX()) {
            $dhkpModel21 = new DhkpModel21();
            $data = [
                'tampildata' => $this->dhkpModel21->table('pbb_dhkp21')
                    ->where('ket', '>1')
                    ->where('dusun', $user)
                    ->findAll()
            ];

            $msg = [
                'data' => view('pbb/dhkp21/pbbterhutang', $data)
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
            'namaApp' => 'KolektorPBB',
            'title' => 'Form. Tambah Data',
            'validation' => \Config\Services::validation()
        ];
        return view('pbb/dhkp21/add', $data);
    }

    public function ambilDataPelanggan()
    {
        if ($this->request->isAJAX()) {
            $request = service('request');
            $postData = $request->getPost();

            $response = array();

            // Read new token and assign in $response['token']
            $response['token'] = csrf_hash();

            if (!isset($postData['searchTerm'])) {
                // Fetch record
                $Pelanggan = new PelangganModel();
                $dataPelanggan = $Pelanggan->select('id_pelanggan, nama_pelanggan')
                    ->orderBy('nama_pelanggan')
                    ->findAll(5);
            } else {
                $searchTerm = $this->request->getVar('searchTerm');
                // fetch record
                $Pelanggan = new PelangganModel();
                $dataPelanggan =  $Pelanggan->select('id_pelanggan, nama_pelanggan')
                    ->like('nama_pelanggan', $searchTerm)
                    ->orderBy('nama_pelanggan')
                    ->findAll(5);
            }

            $data = [];
            foreach ($dataPelanggan as $row) :
                $data[] = array(
                    "id" => $row['id_pelanggan'],
                    "text" => $row['nama_pelanggan']
                );
            endforeach;

            $response['data'] = $data;

            return $this->response->setJSON($response);
            // }
        }
    }


    function export()
    {
        // echo 'sukses';
        // die;
        // $model = new Usulan22Model();
        // $tmbExpData = $this->request->getVar('btnExpData');
        // $tmbExpAll = $this->request->getVar('btnExpAll');
        $filter1 = $this->request->getPost('data_desa');
        $filter2 = $this->request->getPost('data_dusun');
        $filter3 = $this->request->getPost('data_rw');
        $filter4 = $this->request->getPost('data_rt');
        $filter5 = $this->request->getPost('keterangan');

        // if ($filter2 == null || $filter3 == null || $filter6 == null) {

        //     session()->setFlashdata('message', '<strong>Syarat Export</strong>: [-NAMA DESA, -JENIS PROGRAM, -TAHUN dan -BULAN] TIDAK BOLEH KOSONG!!');
        //     return redirect()->to('/dtks/usulan22');
        // } else {
        // dd($filter2, $filter3, $filter4, $filter5);

        $data = $this->dhkpModel21->dataExport($filter2, $filter3, $filter4, $filter5)->getResultArray();

        // dd($data);

        $file_name = 'DHKP DESA-' . $filter1 . '-DUSUN-' . $filter2 . '-RW-' . $filter3 . '-RT-' . $filter4 . '-KET-' . $filter5 . '.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'DAFTAR HIMPUNAN KETETAPAN PAJAK');
        $sheet->setCellValue('A2', 'KECAMATAN PAKENJENG');
        $sheet->setCellValue('A4', 'DESA/KEL. : PASIRLANGU');
        $sheet->setCellValue('F4', 'NO. RW : ' . $filter3);
        $sheet->setCellValue('A5', 'NO. DUSUN : ' . $filter2);
        $sheet->setCellValue('F5', 'NO. RT : ' . $filter4);
        $sheet->setCellValue('A7', 'NO');
        $sheet->setCellValue('B7', "NO. OBJEK PAJAK");
        $sheet->setCellValue('C7', 'NAMA WP');
        $sheet->setCellValue('D7', 'ALAMAT WP');
        $sheet->setCellValue('E7', 'ALAMAT OP');
        $sheet->setCellValue('F7', "BUMI\n(M2)");
        $sheet->setCellValue('G7', "BGN\n(M2)");
        $sheet->setCellValue('H7', "PAJAK\n(RP.)");
        $sheet->setCellValue('I7', 'KET');

        $styleKop = [
            'font' => [
                'bold' => true,
                // 'color' => array('rgb' => 'FFFFFF'),
                'size' => 14,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'wrapText'     => TRUE,
            ],
            'borders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ];

        $styleHead = [
            'font' => [
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'wrapText'     => TRUE,
            ],
            'borders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                // 'rotation' => 90,
                'startColor' => [
                    'rgb' => '4472C4',
                ],
                'endColor' => [
                    'rgb' => '4472C4',
                ],
            ],
        ];

        $stBadan = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN //细边框
                ]
            ]
        ];

        $count = 8;

        foreach ($data as $row) {

            $sheet->setCellValue('A' . $count, $count - 7);
            $sheet->setCellValueExplicit('B' . $count, $row['nop'], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('C' . $count, strtoupper($row['nama_wp']));
            $sheet->setCellValue('D' . $count, strtoupper($row['alamat_wp']));
            $sheet->setCellValue('E' . $count, strtoupper($row['alamat_op']));
            $sheet->setCellValue('F' . $count, $row['bumi']);
            $sheet->setCellValue('G' . $count, $row['bgn']);
            $sheet->setCellValue('H' . $count, $row['pajak']);
            $sheet->setCellValue('I' . $count, $row['sta_keterangan']);

            $count++;
        }

        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleKop);
        $spreadsheet->getActiveSheet()->mergeCells('A1:I1');
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleKop);
        $spreadsheet->getActiveSheet()->mergeCells('A2:I2');
        $spreadsheet->getActiveSheet()->mergeCells('A4:B4');
        $spreadsheet->getActiveSheet()->mergeCells('F4:I4');
        $spreadsheet->getActiveSheet()->mergeCells('F5:I5');
        $spreadsheet->getActiveSheet()->mergeCells('A5:B5');
        $spreadsheet->getActiveSheet()->getStyle('A7:I7')->applyFromArray($styleHead);
        $spreadsheet->getActiveSheet()->getStyle("F:H")->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('A7' . ':' . 'I' . $count)->applyFromArray($stBadan);
        $spreadsheet->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(7, 7);

        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_LEGAL);
        // $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        // $spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);
        $spreadsheet->getActiveSheet()->getPageMargins()->setTop(0.75);
        $spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.5);
        $spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.5);
        $spreadsheet->getActiveSheet()->getPageMargins()->setBottom(0.5);
        // $spreadsheet->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        // $spreadsheet->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
        // $sheet->setTitle('DATA');

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
        // }
    }
}
