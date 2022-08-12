<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class TrxModel22 extends Model
{
    protected $table      = 'pbb_transaksi22';
    protected $primaryKey = 'id_tr';

    protected $allowedFields = ['tr_faktur', 'tr_tgl', 'pelanggan_id', 'id_wil', 'tr_dispersen', 'tr_disuang', 'tr_totalkotor', 'tr_totalbersih', 'tr_jmluang', 'tr_sisauang'];

    public function search($keyword)
    {
        // if ($tombolCari == false) {
        //     return $this->findAll();
        // }
        // return $this->where(['id' => $id])->first();

        return $this->table('pbb_transaksi22')->like('tr_faktur', $keyword)
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
        $query = $this->db->query("SELECT * FROM pbb_transaksi22 a
        WHERE ket = 'Belum bayar'
        ORDER BY a.id DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
    }

    public function getData()
    {
        $builder = $this->db->table('pbb_transaksi22');
        $builder->select('*');
        $builder->join('pbb_pelanggan', 'pbb_pelanggan.id_pelanggan = pbb_transaksi22.pelanggan_id');
        $query = $builder->get();

        return $query;
    }

    public function getDataRekDus()
    {
        $builder = $this->db->table('pbb_dhkp21');
        $builder->select('dusun, nama_kadus');
        $builder->join('tbl_dusun', 'tbl_dusun.no_dusun = pbb_dhkp21.dusun');
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.dusun=tbl_dusun.no_dusun) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.dusun=tbl_dusun.no_dusun && pbb_dhkp21.ket=0) AS pajak2', false);

        $builder->distinct();
        $query = $builder->get();
        return $query;
    }

    public function getDataRekRw()
    {
        $builder = $this->db->table('pbb_dhkp21');
        $builder->select('rw, nama_rw');
        $builder->join('tbl_rw', 'tbl_rw.no_rw = pbb_dhkp21.rw');
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.rw=tbl_rw.no_rw) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.rw=tbl_rw.no_rw && pbb_dhkp21.ket=0) AS pajak2', false);

        $builder->distinct();
        $builder->orderBy('rw');
        $query = $builder->get();
        return $query;
    }

    public function getDataRekRt()
    {
        $builder = $this->db->table('tbl_rt');
        $builder->select('id_dusun, id_rt, id_rw, nama_rt, id_wil');
        // $builder->join('tbl_dusun', 'tbl_dusun.no_dusun = tbl_rt.id_dusun');
        // $builder->join('tbl_rw', 'tbl_rw.no_rw = tbl_rt.id_rw');
        $builder->join('pbb_dhkp21', 'pbb_dhkp21.rw = tbl_rt.id_rw');
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.rw=tbl_rt.id_rw && pbb_dhkp21.rt=tbl_rt.id_rt) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp21.pajak) FROM pbb_dhkp21 WHERE pbb_dhkp21.rw=tbl_rt.id_rw && pbb_dhkp21.rt=tbl_rt.id_rt && pbb_dhkp21.ket=0) AS pajak2', false);

        $builder->distinct();
        $builder->orderBy('id_rw');
        $query = $builder->get();
        return $query;
    }

    public function getDetail($id_tr = false)
    {
        $builder = $this->db->table('pbb_transaksi22');
        $builder->select('*');
        $builder->join('pbb_pelanggan', 'pbb_pelanggan.id_pelanggan = pbb_transaksi22.pelanggan_id');
        $builder->join('pbb_detailtrans21', 'pbb_detailtrans21.dettr_faktur = pbb_transaksi22.tr_faktur');
        $builder->where(['pbb_transaksi22.id_tr' => $id_tr]);
        $query = $builder->get()->getResultArray();

        return $query;
    }
}
