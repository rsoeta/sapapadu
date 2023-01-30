<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DusunModel;
use App\Models\RwModel;
use App\Models\RtModel;
use App\Models\Pbb\AuthModel;
use App\Models\Pbb\DhkpModel;
use App\Models\Pbb\DhkpModel22;
use App\Models\Pbb\TempModel;
use App\Models\Pbb\TrxModel22;
use App\Models\Pbb\DetailTransModel;
use App\Models\Pbb\ModelPbbTerhutang;
use Config\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Trx22 extends BaseController
{
    protected $dhkpModel22;
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->dhkpModel = new DhkpModel();
        $this->dhkpModel22 = new DhkpModel22();
        $this->temp = new TempModel();
        $this->TrxModel22 = new TrxModel22();
        $this->dettrans = new DetailTransModel();
        $this->dusun = new DusunModel();
        $this->rw = new RwModel();
        $this->rt = new RtModel();
        $this->auth = new AuthModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Transaksi 2022'
        ];
        return view('pbb/transaksi/2022/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $this->TrxModel22->getData()->getResultArray()
            ];

            $msg = [
                'data' => view('pbb/transaksi/2022/trans22', $data)
            ];

            echo json_encode($msg);
        } else {
            return redirect()->to('lockscreen');
        }
    }

    public function rekdus()
    {
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'Data Rekap Per-Dusun'
        ];
        return view('pbb/rekap/2022/dusun', $data);
    }

    public function ambildatarekdus()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $this->trans->getDataRekDus()->getResultArray()
            ];
            // var_dump($data);

            $msg = [
                'data' => view('pbb/rekap/2022/rekDusun', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function rekrw()
    {
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'Data Rekap Per-RW'
        ];
        return view('pbb/rekap/2022/rw', $data);
    }

    public function ambildatarekrw()
    {
        if ($this->request->isAJAX()) {
            // $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $this->trans->getDataRekRw()->getResultArray()
            ];
            // var_dump($data);

            $msg = [
                'data' => view('pbb/rekap/2022/rekRw', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function rekrt()
    {
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'Data Rekap Per-RT'
        ];
        return view('pbb/rekap/2022/rt', $data);
    }

    public function ambildatarekRt()
    {

        if ($this->request->isAJAX()) {
            // $dhkpModel22 = new DhkpModel22();
            $data = [
                'tampildata' => $this->trans->getDataRekRt()->getResultArray()
            ];
            // var_dump($data);

            $msg = [
                'data' => view('pbb/rekap/2022/rekRt', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf permintaan anda tidak dapat diproses');
        }
    }

    public function detail($id_tr = null)
    {
        // dd($id_tr);
        // $nofaktur = '';
        $data = [
            'namaApp' => 'KolektorPBB',
            'title' => 'Lampiran Pembayaran PBB-P2 Tahun 2022',
            'detail' => $this->TrxModel22->getDetail($id_tr),
            // 'nofaktur' => $nofaktur
        ];

        // var_dump($data);

        // jika user tidak ada di tabel
        if (empty($data['detail'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('ID Transaksi ' . $id_tr . ' tidak ditemukan.');
        }

        return view('pbb/transaksi/2022/invoice-print', $data);
    }

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id_tr = $this->request->getVar('id_tr');

            // $dhkpModel22 = new DhkpModel22();
            $row = $this->trans->find($id_tr);

            $data = [
                'id_tr' => $row['id_tr'],
                'tr_faktur' => $row['tr_faktur'],
                'tr_tgl' => $row['tr_tgl'],
                'id_wil' => $row['id_wil'],
                'tr_dispersen' => $row['tr_dispersen'],
                'tr_disuang' => $row['tr_disuang'],
                'tr_totalkotor' => $row['tr_totalkotor'],
                'tr_totalbersih' => $row['tr_totalbersih'],
                'tr_jmluang' => $row['tr_jmluang'],
                'tr_sisauang' => $row['tr_sisauang'],
            ];

            $msg = [
                'sukses' => view('pbb/transaksi/2022/pembayaran', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function cek()
    {
        $cart = \Config\Services::cart();
        $response = $cart->contents();
        $data = json_encode($response);
        echo '<pre>';
        print_r($data);
        // print_r($response);
        echo '</pre>';
    }
    // Clear the shopping cart
    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
    }

    function tgl()
    {

        return date("Y-m-d");
    }

    public function pembayaran($id_tr = null)
    {

        $data = [
            'title' => 'Checkout',
            'nofaktur' => $this->buatFaktur(),
            'tgl' => $this->tgl(),
            'sekretariat' => $this->auth->getUserId(),
            'detail' => $this->TrxModel22->getDetail($id_tr),
        ];
        return view('pbb/transaksi/2022/invoice-print', $data);
    }

    public function buatFaktur()
    {
        $db = \Config\Database::connect();
        // $tgl = date('Y-m-d');
        $kode_desa = substr(detailUser()->pu_kode_desa, 9, 4);
        $tgl = $this->tgl();
        $query = $db->query("SELECT MAX(tr_faktur) AS nofaktur FROM pbb_transaksi22 WHERE DATE_FORMAT(tr_tgl, '%Y-%m-%d') ='$tgl' ");
        $hasil = $query->getRowArray();
        $data = $hasil['nofaktur'];

        $lastNoUrut = substr($data, -3);

        // nomor urut ditambah 1
        $nextNoUrut = intval($lastNoUrut) + 1;

        // membuat format nomor transaksi berikutnya
        $fakturTransaksi = '#SAPAPADU' . $kode_desa . date('ymd', strtotime($tgl)) . sprintf('%03s', $nextNoUrut);

        return $fakturTransaksi;
    }

    public function dataDetail()
    {
        $db = \Config\Database::connect();
        // $nofaktur = "#KDPSL010170001";
        $nofaktur = $this->request->getVar('nofaktur');
        $tahun_ini = date('Y');

        $tempTr = $db->table('pbb_temptrans21');
        $queryTampil = $tempTr
            ->select('pbb_temptrans21.id as id, pbb_dhkp22.nama_wp, pbb_dhkp22.nama_ktp, pbb_dhkp22.alamat_wp, pbb_dhkp22.alamat_op, dettr_faktur, pbb_temptrans21.nop, pbb_temptrans21.pajak, pbb_temptrans21.ket, dettr_subtotal as subtotal')
            ->join('pbb_dhkp22', 'pbb_temptrans21.nop = pbb_dhkp22.nop')
            ->where('dettr_faktur', $nofaktur)
            ->where('pd_tahun', $tahun_ini)
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

    public function dataDetailTrans()
    {
        // $nofaktur = "#KDPSL010170001";
        $nofaktur = $this->request->getVar('nofaktur');

        $tempTr = $db->table('pbb_detailtrans21');
        $queryTampil = $tempTr
            ->select('pbb_detailtrans21.id as id, pbb_dhkp22.nama_wp, pbb_dhkp22.nama_ktp, pbb_dhkp22.alamat_wp, pbb_dhkp22.alamat_op, dettr_faktur, pbb_detailtrans21.nop, pbb_detailtrans21.pajak, pbb_detailtrans21.ket, dettr_subtotal as subtotal')
            ->join('pbb_dhkp22', 'pbb_detailtrans21.nop = pbb_dhkp22.nop')
            ->where('dettr_faktur', $nofaktur)
            ->orderBy('dettr_faktur', 'asc');

        $data = [
            'datadetail' => $queryTampil->get(),
            'faktur' => $nofaktur
        ];
        // dd($data);

        $msg = [
            'data' => view('pbb/transaksi/2022/detailtr', $data)
        ];

        echo json_encode($msg);
    }

    public function dataTerhutang()
    {
        if ($this->request->isAJAX()) {
            $keyword = $this->request->getPost('keyword');
            $data = [
                'keyword' => $keyword
            ];
            $msg = [
                'title' => 'Data PBB Terhutang',
                'viewmodal' => view('pbb/dhkp22/modalDataTerhutang', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function listPbbTerhutang()
    {
        if ($this->request->isAJAX()) {
            $keywordnop = $this->request->getPost('keywordnop');
            $keyTahun = date('Y');

            $request = Services::request();
            $modelTerhutang = new ModelPbbTerhutang($request);
            if ($request->getMethod(true) == 'POST') {
                $lists = $modelTerhutang->get_datatables($keywordnop, $keyTahun);
                $data = [];
                $no = $request->getPost("start");
                foreach ($lists as $list) {
                    $no++;
                    $row = [];
                    $row[] = $no;
                    $row[] = $list->id;
                    $row[] = $list->nop;
                    $row[] = $list->nama_wp;
                    $row[] = $list->alamat_op;
                    $row[] = number_format($list->pajak, 0, ",", ",");
                    $row[] = $list->pd_ket;
                    // $row[] = $list->td_kadus_nama;
                    $row[] = "<button type=\"button\" class=\"btn btn-sm btn-primary\" onclick=\"pilihitem('" . $list->id . "', '" . $list->nop . "', '" . $list->nama_wp . "')\">Pilih</button>";
                    $data[] = $row;
                }
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => $modelTerhutang->count_all($keywordnop, $keyTahun),
                    "recordsFiltered" => $modelTerhutang->count_filtered($keywordnop, $keyTahun),
                    "data" => $data
                ];
                echo json_encode($output);
            }
        }
    }

    public function simpanTemp()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $id = $this->request->getPost('id');
            $nop = $this->request->getPost('nop');
            $nama_wp = $this->request->getPost('nama_wp');
            $tahun_ini = date('Y');
            $nofaktur = $this->request->getPost('nofaktur');

            if (strlen($nama_wp && $tahun_ini) > 0) {
                $queryCekData = $db->table('pbb_dhkp22')->where('id', $id)->where('nop', $nop)->where('nama_wp', $nama_wp)->where('pd_tahun', $tahun_ini)->get();
            } else {
                $queryCekData = $db->table('pbb_dhkp22')->where('pd_tahun', $tahun_ini)->like('nop', $nop)->orLike('nama_wp', $nop)->get();
            }

            $totalData = $queryCekData->getNumRows();

            if ($totalData > 1) {
                $msg = [
                    'totaldata' => 'banyak'
                ];
            } elseif ($totalData == 1) {
                // lakukan insert ke temp transaksi
                $tblTempTrans = $db->table('pbb_temptrans21');

                $rowData = $queryCekData->getRowArray();

                $stokData = $rowData['pd_ket'];

                if (intval($stokData) == 0) {
                    $msg = [
                        'error' => 'PBB telah lunas'
                    ];
                } else {

                    $insertData = [
                        'dettr_faktur' => $nofaktur,
                        'nop' => $rowData['nop'],
                        'pajak' => $rowData['pajak'],
                        'ket' => $rowData['pd_ket'],
                        'dettr_subtotal' => floatval($rowData['pajak']) * $rowData['pd_ket']
                    ];

                    $tblTempTrans->insert($insertData);

                    $msg = ['sukses' => 'berhasil'];
                }
            } else {
                $msg = ['error' => 'Maaf data tidak ditemukan'];
            }
            echo json_encode($msg);
        }
    }

    public function hitungTotalBayar()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $nofaktur = $this->request->getPost('nofaktur');

            $tblTempTrans = $db->table('pbb_temptrans21');

            $queryTotal = $tblTempTrans->select('SUM(dettr_subtotal) as totalbayar')->where('dettr_faktur', $nofaktur)->get();
            $rowTotal = $queryTotal->getRowArray();

            $msg = [
                'totalbayar' => number_format($rowTotal['totalbayar'], 0, ",", ".")
            ];
            // dd($msg);
            echo json_encode($msg);
        }
    }

    public function hapusItem()
    {
        $db = \Config\Database::connect();
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $tblTempTrans = $db->table('pbb_temptrans21');
            $queryHapus = $tblTempTrans->delete(['id' => $id]);

            if ($queryHapus) {
                $msg = [
                    'sukses' => 'berhasil'
                ];
                echo json_encode($msg);
            }
        }
    }

    public function batalTransaksi()
    {
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');

            $tblTempTrans = $db->table('pbb_temptrans21');
            $hapusData =  $tblTempTrans->emptyTable();

            if ($hapusData) {
                $msg = [
                    'sukses' => 'berhasil'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function bayar()
    {
        $db = \Config\Database::connect();
        if ($this->request->isAJAX()) {
            $pelanggan_id = $this->request->getPost('pelanggan_id');
            $nofaktur = $this->request->getPost('nofaktur');
            $id_wil = $this->request->getPost('id_wil');

            $tblTempTrans = $db->table('pbb_temptrans21');

            $cekDataTempTrans = $tblTempTrans->getWhere(['dettr_faktur' => $nofaktur]);
            $queryTotal = $tblTempTrans->select('SUM(dettr_subtotal) as totalbayar')->where('dettr_faktur', $nofaktur)->get();
            $rowTotal = $queryTotal->getRowArray();

            if ($cekDataTempTrans->getNumRows() > 0) {
                // modal bayar
                $data = [
                    'nofaktur' => $nofaktur,
                    'pelanggan_id' => $pelanggan_id,
                    'id_wil' => $id_wil,
                    'totalbayar' => $rowTotal['totalbayar']
                ];
                // var_dump($data);

                $msg = [
                    'data' => view('pbb/transaksi/2022/modalbayar', $data)
                ];
            } else {
                $msg = [
                    'error' => 'Maaf item belum ada'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function simpanBayar()
    {
        $db = \Config\Database::connect();
        if ($this->request->isAJAX()) {
            $nofaktur = $this->request->getPost('nofaktur');
            $pelanggan_id = $this->request->getPost('pelanggan_id');
            $id_wil = $this->request->getPost('id_wil');
            $totalkotor = $this->request->getPost('totalkotor');
            $totalbersih = str_replace(",", "", $this->request->getPost('totalbersih'));
            $dispersen = str_replace(",", "", $this->request->getPost('dispersen'));
            $disuang = str_replace(",", "", $this->request->getPost('disuang'));
            $jmluang = str_replace(",", "", $this->request->getPost('jmluang'));
            $sisauang = str_replace(",", "", $this->request->getPost('sisauang'));

            $tblTransaksi = $db->table('pbb_transaksi22');
            $tblTempTrans = $this->temp->table('pbb_temptrans21');
            $tblDetailTrans = $this->dettrans->table('pbb_detailtrans21');

            // insert ke tabel transaksi
            $dataInsertTrans = [
                'tr_faktur' => $nofaktur,
                'tr_tgl' => date("Y-m-d H:m:s"),
                'pelanggan_id' => $pelanggan_id,
                'id_wil' => $id_wil,
                'tr_dispersen' => $dispersen,
                'tr_disuang' => $disuang,
                'tr_totalkotor' => $totalkotor,
                'tr_totalbersih' => $totalbersih,
                'tr_jmluang' => $jmluang,
                'tr_sisauang' => $sisauang
            ];

            // var_dump($dataInsertTrans);
            $tblTransaksi->insert($dataInsertTrans);


            // insert ke tabel detailtransaksi
            $ambilDataTemp = $tblTempTrans->getWhere(['dettr_faktur' => $nofaktur]);

            $fieldDetailTrans = [];
            foreach ($ambilDataTemp->getResultArray() as $row) {
                $fieldDetailTrans[] = [
                    'dettr_faktur' => $row['dettr_faktur'],
                    'nop' => $row['nop'],
                    'pajak' => $row['pajak'],
                    'ket' => $row['ket'],
                    'dettr_subtotal' => $row['dettr_subtotal'],
                ];
            }
            $tblDetailTrans->insertBatch($fieldDetailTrans);

            // hapus temp
            $tblTempTrans->emptyTable();

            $msg = [
                'sukses' => 'berhasil'
            ];
            echo json_encode($msg);
        }
    }

    public function export()
    {
        $trans = $this->TrxModel22->getData()->getResultArray();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NO. FAKTUR')
            ->setCellValue('C1', 'TANGGAL TRANSAKSI')
            ->setCellValue('D1', 'NAMA PENYETOR')
            ->setCellValue('E1', 'JUMLAH SETOR');

        $column = 2;

        foreach ($trans as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $column - 1)
                ->setCellValue('B' . $column, $row['tr_faktur'])
                ->setCellValue('C' . $column, $row['tr_tgl'])
                ->setCellValue('D' . $column, $row['nama_pelanggan'])
                ->setCellValue('E' . $column, $row['tr_totalbersih']);

            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-Data-Transaksi';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function exportRekRT()
    {
        $exports = $this->trans->getDataRekRt()->getResultArray();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'NO')
            ->setCellValue('B1', 'NO. RW')
            ->setCellValue('C1', 'NO. RT')
            ->setCellValue('D1', 'NAMA KETUA RT')
            ->setCellValue('E1', 'TARGET SETOR')
            ->setCellValue('F1', 'JUMLAH SETOR')
            ->setCellValue('G1', 'SISA SETOR')
            ->setCellValue('H1', 'PERSENTASE');

        $column = 2;

        foreach ($exports as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $column - 1)
                ->setCellValue('B' . $column, $row['id_rw'])
                ->setCellValue('C' . $column, $row['id_rt'])
                ->setCellValue('D' . $column, $row['nama_rt'])
                ->setCellValue('E' . $column, $row['pajak1'])
                ->setCellValue('F' . $column, $row['pajak2'])
                ->setCellValue('G' . $column, $row['pajak1'] - $row['pajak2'])
                ->setCellValue('H' . $column, round(($row['pajak2'] / $row['pajak1']) * 100));

            $column++;
        }



        $writer = new Xlsx($spreadsheet);
        $filename = '-Data-Rekap-Per-RT' . date('Y-m-d-His');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
