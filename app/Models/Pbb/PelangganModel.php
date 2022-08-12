<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table      = 'pbb_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $returnType = 'array';
    protected $allowedFields = ['nik', 'no_kk', 'nama_pelanggan', 'tgl_lahir', 'id_rt', 'id_rw', 'id_dusun', 'id_wil', 'alamat_pelanggan', 'no_hp', 'hari', 'kode_jabatan', 'time_stamps', 'foto'];
    protected $useTimestamps = false;
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
