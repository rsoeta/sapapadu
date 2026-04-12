<?php

namespace App\Controllers\Pbb;

use App\Controllers\BaseController;

class Validasi extends BaseController
{
    public function index($faktur, $token)
    {
        helper('struk');

        if ($token !== struk_token($faktur)) {
            return "❌ DATA TIDAK VALID";
        }

        $db = \Config\Database::connect();

        $data = $db->table('pbb_transaksi22')
            ->where('tr_faktur', $faktur)
            ->get()
            ->getRowArray();

        if (!$data) {
            return "❌ DATA TIDAK DITEMUKAN";
        }

        return view('pbb/struk/validasi', $data);
    }
}
