<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class DhkpModel extends Model
{
    protected $table      = 'pbb_dhkp';
    protected $primaryKey = 'id_sppt';

    protected $allowedFields = ['nop', 'nama_wp', 'alamat_wp', 'alamat_op', 'bumi', 'bgn', 'pajak', 'nik_wp', 'nama_ktp', 'dusun', 'rw', 'rt', 'ket'];

    protected $useTimestamps = true;
    protected $skipValidation     = false;
    public function search($keyword)
    {
        // if ($tombolCari == false) {
        //     return $this->findAll();
        // }
        // return $this->where(['id' => $id])->first();

        return $this->table('pbb_dhkp')->like('nop', $keyword)
            ->orlike('nama_wp', $keyword)
            ->orlike('alamat_wp', $keyword)
            ->orlike('alamat_op', $keyword)
            ->orlike('bumi', $keyword)
            ->orlike('bgn', $keyword)
            ->orlike('pajak', $keyword)
            ->orlike('nik_wp', $keyword)
            ->orlike('nama_ktp', $keyword)
            ->orlike('dusun', $keyword)
            ->orlike('rw', $keyword)
            ->orlike('rt', $keyword)
            ->orlike('ket', $keyword);
    }
    public function fetchData($limit, $start)
    {
        $query = $this->db->query("SELECT * FROM dhkp a
        WHERE ket = 'Belum bayar'
        ORDER BY a.id DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
    }
}
