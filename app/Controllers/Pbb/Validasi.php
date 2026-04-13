<?php

namespace App\Controllers\Pbb;

use App\Controllers\BaseController;

class Validasi extends BaseController
{
    public function index($faktur, $token)
    {
        helper('struk');

        // 🔥 normalisasi
        $faktur_clean = str_replace('#', '', $faktur);

        // 🔥 validasi token
        if ($token !== struk_token($faktur_clean)) {
            return view('pbb/validasi/error', [
                'message' => 'Token tidak valid'
            ]);
        }

        $db = \Config\Database::connect();

        // 🔥 cari data (handle #)
        $data = $db->table('pbb_transaksi22 t')
            ->join('pbb_pelanggan p', 'p.id_pelanggan = t.pelanggan_id', 'left')
            ->like('tr_faktur', $faktur_clean)
            ->get()
            ->getRowArray();

        if (!$data) {
            return view('pbb/validasi/error', [
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return view('pbb/validasi/sukses', [
            'data' => $data
        ]);
    }
}
