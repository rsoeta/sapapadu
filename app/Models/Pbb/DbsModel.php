<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class DbsModel extends Model
{
    protected $table      = 'dhkp';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nop', 'nama_wp', 'alamat_wp', 'alamat_op', 'bumi', 'bgn', 'pajak', 'nik_wp', 'nama_ktp', 'dusun', 'rw', 'rt', 'ket'];

    protected $useTimestamps = true;
    protected $skipValidation     = false;


    function index()
    {
        $this->db->setDatabase('ci4_pbb');
        $builder = $this->db->table('dhkp');

        $post = $builder->get()->getResult();
        return $post;
    }
    function getDhkp($limit = false){
        $builder = $this->db->table('dhkp');
        $builder->join('tbl_dusun', 'dhkp.dusun = tbl_dusun.no_dusun');
        $dhkp = $builder->get()->getResult();
        return $dhkp;
    }

    function getKadus($limit = false){
        $builder = $this->db->table('tbl_dusun');
        
        if($limit)
        $builder->limit($limit);

        $dhkp = $builder->get()->getResult();
        return $dhkp;
    }

    function getDhkplain($limit = false){
        $builder = $this->db->table('tb_sppt');
        
        if($limit)
        $builder->limit($limit);

        $dhkp = $builder->get()->getResult();
        return $dhkp;
    }

    public function search($keyword)
    {
        // if ($tombolCari == false) {
        //     return $this->findAll();
        // }
        // return $this->where(['id' => $id])->first();
        return $this->table('dhkp')->like('nop', $keyword)
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
