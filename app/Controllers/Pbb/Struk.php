<?php

namespace App\Controllers\Pbb;

use App\Controllers\BaseController;

class Struk extends BaseController
{

    public function index($faktur, $token)
    {
        helper(['terbilang', 'struk']);

        // bersihkan faktur
        $faktur_clean = str_replace('#', '', $faktur);

        // validasi token
        if ($token !== struk_token($faktur_clean)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $faktur_db = '#' . $faktur_clean;

        $db = \Config\Database::connect();

        $builder = $db->table('pbb_transaksi22 t');
        $builder->select('
            t.tr_faktur,
            t.tr_tgl,
            t.tr_totalbersih,

            d.nop,
            d.pajak,
            d.ket,

            p.nama_pelanggan as nama_wp,
            p.alamat_pelanggan as alamat_wp
        ');

        $builder->join('pbb_detailtrans21 d', 'd.dettr_faktur = t.tr_faktur');
        $builder->join('pbb_pelanggan p', 'p.id_pelanggan = t.pelanggan_id');
        $builder->where('t.tr_faktur', $faktur_db);

        $data = $builder->get()->getRowArray();

        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['terbilang'] = terbilang($data['tr_totalbersih']);
        $data['tgl_format'] = date('d-m-Y H:i', strtotime($data['tr_tgl']));
        $data['validasi_url'] = validasi_url($faktur_clean);

        return view('pbb/struk/struk_single', $data);
    }

    public function pdf($faktur, $token)
    {
        helper(['struk']);

        if ($token !== struk_token($faktur)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $html = $this->index($faktur, $token);

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 226.77, 600], 'portrait'); // 80mm
        $dompdf->render();
        $dompdf->stream("struk.pdf", ["Attachment" => false]);
    }

    public function kolektif($faktur, $token)
    {
        helper(['struk', 'terbilang']);

        $faktur_clean = str_replace('#', '', $faktur);

        if ($token !== struk_token($faktur_clean)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $faktur_db = '#' . $faktur_clean;

        $db = \Config\Database::connect();

        $builder = $db->table('pbb_transaksi22 t');
        $builder->select('
            t.tr_faktur,
            t.tr_tgl,
            t.tr_totalbersih,
            p.nama_pelanggan,
            p.alamat_pelanggan
        ');

        $builder->join('pbb_pelanggan p', 'p.id_pelanggan = t.pelanggan_id');
        $builder->where('t.tr_faktur', $faktur_db);

        $header = $builder->get()->getRowArray();

        $tahun = date('Y', strtotime($header['tr_tgl']));

        $detail = $db->table('pbb_detailtrans21 d')
            ->select('
                    d.nop,
                    d.pajak,
                    dh.nama_wp,
                    dh.alamat_wp,
                    dh.alamat_op
                ')
            ->join(
                'pbb_dhkp22 dh',
                "dh.nop = d.nop AND dh.pd_tahun = {$tahun}",
                'left'
            )
            ->where('d.dettr_faktur', $faktur_db)
            ->get()
            ->getResultArray();

        if (!$header) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'header' => $header,
            'detail' => $detail,
            'terbilang' => terbilang($header['tr_totalbersih']),
            'tgl_format' => date('d-m-Y H:i', strtotime($header['tr_tgl'])),
            'validasi_url' => validasi_url($faktur_clean) // 🔥 TAMBAH INI
        ];

        return view('pbb/struk/struk_kolektif', $data);
    }
}
