<?php

namespace App\Models;

use CodeIgniter\Model;

class RtModel extends Model
{
    protected $table = 'tb_rt';
    protected $primaryKey = 'id';

    protected $allowedFields = ['no_rt', 'no_rw', 'no_dusun', 'kode_desa', 'nama_ketua_rt', 'alamat_rt'];

    public function cariData($cari)
    {
        return $this->table('tb_rt')->like('nama_rt', $cari)
            ->orlike('no_dusun', $cari)
            ->orlike('no_rw', $cari)
            ->orlike('no_rt', $cari);
    }

    public function noRt()
    {
        $role = session()->get('level');
        $desa = session()->get('kode_desa');
        $level = session()->get('jabatan');

        if ($role == 1 && $level == null || ($level != null && $role == 1)) {
            $builder = $this->db->table('tb_rt');
            $builder->select('no_rt')->distinct();
            $query = $builder->get();
        } elseif (($role == 2 && $level == null) || ($level != null && $role == 2)) {
            $builder = $this->db->table('tb_rt');
            $builder->where('kode_desa', $desa);
            $builder->select('no_rt')->distinct();
            $query = $builder->get();
        } elseif ($role == 3) {
            $builder = $this->db->table('tb_rt');
            $builder->where('kode_desa', $desa);
            $builder->select('no_rt')->distinct();
            $query = $builder->get();
        } elseif ($role == 4 && $level != null) {
            $builder = $this->db->table('tb_rt');
            $builder->where('kode_desa', $desa);
            $builder->where('no_rw', $level);
            $builder->select('no_rt')->distinct();
            $query = $builder->get();
        } else {
            $builder = $this->db->table('tb_rt');
            $builder->where('kode_desa', $desa);
            $builder->where('no_rw', $level);
            $builder->select('no_rt');
            $query = $builder->get();
        }

        return $query->getResultArray();
    }

    public function getDataRT($desa, $no_rw)
    {
        $builder = $this->db->table('tb_rt');
        $builder->where('kode_desa', $desa);
        $builder->where('no_rw', $no_rw);
        $builder->select('no_rt');
        $query = $builder->get();

        return $query->getResultArray();
    }
}
