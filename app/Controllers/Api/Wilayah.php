<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Wilayah extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function dusun()
    {
        $kodeDesa = detailUser()->pu_kode_desa;

        return $this->response->setJSON(
            $this->db->table('tb_dusun')
                ->select('td_kode_dusun as dusun, td_nama_dusun as nama')
                ->where('td_kode_desa', $kodeDesa)
                ->get()->getResult()
        );
    }

    public function rw()
    {
        $kodeDesa = detailUser()->pu_kode_desa;
        $dusun = $this->request->getGet('dusun');

        $builder = $this->db->table('tb_rw')
            ->select('no_rw as rw')
            ->where('kode_desa', $kodeDesa);

        if (!empty($dusun)) {
            $builder->where('no_dusun', $dusun);
        }

        return $this->response->setJSON(
            $builder->groupBy('no_rw')->get()->getResult()
        );
    }

    public function rt()
    {
        $kodeDesa = detailUser()->pu_kode_desa;
        $dusun = $this->request->getGet('dusun');
        $rw = $this->request->getGet('rw');

        $builder = $this->db->table('tb_rt')
            ->select('no_rt as rt')
            ->where('kode_desa', $kodeDesa);

        if (!empty($dusun)) $builder->where('no_dusun', $dusun);
        if (!empty($rw)) $builder->where('no_rw', $rw);

        return $this->response->setJSON(
            $builder->groupBy('no_rt')->get()->getResult()
        );
    }

    public function tahun()
    {
        return $this->response->setJSON(
            $this->db->table('pbb_transaksi22')
                ->select('YEAR(tr_tgl) as tahun')
                ->groupBy('YEAR(tr_tgl)')
                ->orderBy('tahun', 'DESC')
                ->get()->getResult()
        );
    }

    private function kodeDesaPublic()
    {
        return '32.05.33.2006'; // atau ambil dari config/env
    }

    public function dusunPublic()
    {
        $kodeDesa = $this->kodeDesaPublic();

        return $this->response->setJSON(
            $this->db->table('tb_dusun')
                ->select('td_kode_dusun as dusun, td_nama_dusun as nama')
                ->where('td_kode_desa', $kodeDesa)
                ->orderBy('td_kode_dusun', 'ASC')
                ->get()->getResult()
        );
    }

    public function rwPublic()
    {
        $kodeDesa = $this->kodeDesaPublic();
        $dusun = $this->request->getGet('dusun');

        $builder = $this->db->table('tb_rw')
            ->select('no_rw as rw')
            ->where('kode_desa', $kodeDesa);

        if ($dusun !== null && $dusun !== '') {
            $builder->where('no_dusun', $dusun);
        }

        return $this->response->setJSON(
            $builder->groupBy('no_rw')->orderBy('no_rw', 'ASC')->get()->getResult()
        );
    }

    public function rtPublic()
    {
        $kodeDesa = $this->kodeDesaPublic();
        $dusun = $this->request->getGet('dusun');
        $rw = $this->request->getGet('rw');

        $builder = $this->db->table('tb_rt')
            ->select('no_rt as rt')
            ->where('kode_desa', $kodeDesa);

        if ($dusun !== null && $dusun !== '') $builder->where('no_dusun', $dusun);
        if ($rw !== null && $rw !== '') $builder->where('no_rw', $rw);

        return $this->response->setJSON(
            $builder->groupBy('no_rt')->orderBy('no_rt', 'ASC')->get()->getResult()
        );
    }
}
