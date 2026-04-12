<?php

namespace App\Controllers\Pbb;

use App\Controllers\BaseController;

class Struk extends BaseController
{
    public function index($id_tr)
    {
        helper(['terbilang']);

        $db = \Config\Database::connect();

        $builder = $db->table('pbb_transaksi22 t');
        $builder->select('
            t.id_tr,
            t.tr_faktur,
            t.tr_tgl,
            t.tr_totalbersih,

            d.nop,
            d.pajak,
            d.ket,

            p.nama_wp,
            p.alamat_wp
        ');

        $builder->join('pbb_detailtrans21 d', 'd.dettr_faktur = t.tr_faktur');
        $builder->join('pbb_pelanggan p', 'p.id_pelanggan = t.pelanggan_id');
        $builder->where('t.id_tr', $id_tr);

        $data = $builder->get()->getRowArray();

        if (!$data) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // format tambahan
        $data['terbilang'] = terbilang($data['tr_totalbersih']);
        $data['tgl_format'] = date('d-m-Y H:i', strtotime($data['tr_tgl']));

        // QR payload (sementara string dulu, nanti kita generate image)
        $data['qr_payload'] = json_encode([
            'faktur' => $data['tr_faktur'],
            'nop'    => $data['nop'],
            'total'  => $data['tr_totalbersih'],
            'status' => 'VALID'
        ]);

        return view('pbb/struk/struk_single', $data);
    }
}
