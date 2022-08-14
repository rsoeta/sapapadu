<?php

namespace App\Models;

use CodeIgniter\Model;

class DusunModel extends Model
{
    protected $table      = 'tb_dusun';
    protected $primaryKey = 'td_id';

    protected $allowedFields = [
        'td_kode_desa',
        'td_kode_dusun',
        'td_nama_dusun',
        'td_kadus_nik',
        'td_kadus_nama',
        'td_kadus_nope',
        'td_kadus_alamat',
    ];

    public function cariData($cari)
    {
        return $this->table('tb_dusun')->like('td_nama_dusun', $cari)->orlike('td_kode_dusun', $cari);
    }

    function getDataDusun($desa)
    {
        $builder = $this->db->table('tb_dusun');
        $builder->where('td_kode_desa', $desa);
        $builder->select('td_kode_dusun, td_nama_dusun, td_kadus_nama')->distinct();
        $query = $builder->get();

        return $query->getResultArray();
    }
}
