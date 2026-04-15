<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pbb\DhkpModel22;

class DashboardPbb extends BaseController
{
    protected $dhkp;

    public function __construct()
    {
        $this->dhkp = new DhkpModel22();
    }

    /**
     * 🎯 KPI UTAMA (1 HIT API)
     */
    public function getKpi()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $desa  = $this->request->getGet('desa');
        $dusun = $this->request->getGet('dusun');
        $rw    = $this->request->getGet('rw');
        $rt    = $this->request->getGet('rt');

        $db = \Config\Database::connect();
        $builder = $db->table('pbb_dhkp22');

        // 🔥 FILTER WILAYAH
        if ($desa)  $builder->where('pd_desa', $desa);
        if ($dusun) $builder->where('dusun', $dusun);
        if ($rw)    $builder->where('rw', $rw);
        if ($rt)    $builder->where('rt', $rt);

        // 🔥 FIX WAJIB (bukan created_at)
        $builder->where('pd_tahun', $tahun);

        $builder->select("
            SUM(pajak) as target,
            SUM(CASE WHEN pd_ket = 0 THEN pajak ELSE 0 END) as capaian,
            SUM(CASE WHEN pd_ket = 1 THEN pajak ELSE 0 END) as sisa,
            SUM(CASE WHEN pd_ket >= 2 THEN pajak ELSE 0 END) as bermasalah
        ");

        $result = $builder->get()->getRow();

        $target = (float) $result->target;
        $capaian = (float) $result->capaian;

        $persentase = $target > 0 ? round(($capaian / $target) * 100, 2) : 0;

        return $this->response->setJSON([
            'target' => $target,
            'capaian' => $capaian,
            'sisa' => (float) $result->sisa,
            'bermasalah' => (float) $result->bermasalah,
            'persentase' => $persentase
        ]);
    }

    /**
     * 🏆 RANKING RT (PALING PENTING)
     */
    public function getRankingRt()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        // $data = $this->dhkp->setoranPerRtFiltered(null, null, null, $tahun);

        // // 🔥 SORT BY PERSENTASE
        // usort($data, function ($a, $b) {
        //     return $b->dataPersentase <=> $a->dataPersentase;
        // });

        // return $this->response->setJSON($data);
        try {

            $data = $this->dhkp->setoranPerRtFiltered(null, null, null, $tahun);

            usort($data, function ($a, $b) {
                return $b->dataPersentase <=> $a->dataPersentase;
            });

            return $this->response->setJSON($data);
        } catch (\Throwable $e) {

            return $this->response->setJSON([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * 📊 CHART KOMPOSISI (PIE / DONUT)
     */
    public function getKomposisi()
    {
        $dusun = $this->request->getGet('dusun');
        $rw    = $this->request->getGet('rw');
        $rt    = $this->request->getGet('rt');

        // 🔥 paksa tahun (lebih aman)
        $tahun = date('Y');

        $builder = \Config\Database::connect()
            ->table('pbb_dhkp22 d')
            ->select("
            SUM(CASE WHEN d.pd_ket = 0 THEN d.pajak ELSE 0 END) as lunas,
            SUM(CASE WHEN d.pd_ket = 1 THEN d.pajak ELSE 0 END) as belum,
            SUM(CASE WHEN d.pd_ket >= 2 THEN d.pajak ELSE 0 END) as bermasalah
        ")
            ->where('d.pd_tahun', $tahun);

        // 🔥 FILTER DINAMIS (INI YANG KURANG TADI)
        if (!empty($dusun)) {
            $builder->where('d.dusun', $dusun);
        }

        if (!empty($rw)) {
            $builder->where('d.rw', $rw);
        }

        if (!empty($rt)) {
            $builder->where('d.rt', $rt);
        }

        $query = $builder->get()->getRow();

        return $this->response->setJSON([
            'lunas'       => (float)($query->lunas ?? 0),
            'belum'       => (float)($query->belum ?? 0),
            'bermasalah'  => (float)($query->bermasalah ?? 0)
        ]);
    }

    public function getTimeline()
    {
        $tahun = $this->request->getGet('tahun');

        $db = \Config\Database::connect();

        $builder = $db->table('pbb_transaksi22 t')
            ->select('DATE(t.tr_tgl) as tanggal, SUM(dt.dettr_subtotal) as total')
            ->join('pbb_detailtrans21 dt', 'dt.dettr_faktur = t.tr_faktur')
            ->join('pbb_dhkp22 d', 'd.nop = dt.nop');

        if ($tahun) {
            $builder->where('YEAR(t.tr_tgl)', $tahun);
        }

        $builder->groupBy('DATE(t.tr_tgl)');
        $builder->orderBy('DATE(t.tr_tgl)', 'ASC');

        return $this->response->setJSON($builder->get()->getResult());
    }
}
