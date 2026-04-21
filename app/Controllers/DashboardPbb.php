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
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $dusun = $this->request->getGet('dusun');
        $rw    = $this->request->getGet('rw');
        $rt    = $this->request->getGet('rt');

        $db = \Config\Database::connect();

        $builder = $db->table('pbb_detailtrans21 dt')
            ->select('DATE(t.tr_tgl) as tanggal, SUM(dt.dettr_subtotal) as total')
            ->join('pbb_transaksi22 t', 't.tr_faktur = dt.dettr_faktur')
            ->join(
                "(SELECT DISTINCT nop, dusun, rw, rt 
            FROM pbb_dhkp22 
            WHERE pd_tahun = {$tahun}) d",
                'd.nop = dt.nop'
            );

        $builder->where('YEAR(t.tr_tgl)', $tahun);

        // 🔥 filter wilayah (baru join d berguna)
        if (!empty($dusun)) $builder->where('d.dusun', $dusun);
        if (!empty($rw))    $builder->where('d.rw', $rw);
        if (!empty($rt))    $builder->where('d.rt', $rt);

        $builder->groupBy('DATE(t.tr_tgl)');
        $builder->orderBy('DATE(t.tr_tgl)', 'ASC');

        return $this->response->setJSON($builder->get()->getResult());
    }

    /**
     * 📊 CHART PROGRES PER DUSUN
     */
    public function getProgressDusun()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $db = \Config\Database::connect();

        $builder = $db->table('pbb_dhkp22 d')
            ->select('d.dusun, SUM(d.pajak) as target, SUM(CASE WHEN d.pd_ket = 0 THEN d.pajak ELSE 0 END) as capaian')
            ->where('d.pd_tahun', $tahun)
            ->groupBy('d.dusun')
            ->orderBy('CAST(d.dusun AS UNSIGNED)', 'ASC');

        $result = $builder->get()->getResult();
        $data = [];
        foreach ($result as $row) {
            $persen = $row->target > 0 ? round(($row->capaian / $row->target) * 100, 2) : 0;
            $data[] = [
                'label' => 'Dusun ' . $row->dusun,
                'persentase' => $persen
            ];
        }
        return $this->response->setJSON($data);
    }

    /**
     * 📊 CHART PROGRES PER RW
     */
    public function getProgressRw()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $dusun = $this->request->getGet('dusun'); // Bisa difilter per dusun

        $db = \Config\Database::connect();
        $builder = $db->table('pbb_dhkp22 d')
            ->select('d.rw, SUM(d.pajak) as target, SUM(CASE WHEN d.pd_ket = 0 THEN d.pajak ELSE 0 END) as capaian')
            ->where('d.pd_tahun', $tahun);

        if (!empty($dusun)) {
            $builder->where('d.dusun', $dusun);
        }

        $builder->groupBy('d.rw')->orderBy('CAST(d.rw AS UNSIGNED)', 'ASC');

        $result = $builder->get()->getResult();
        $data = [];
        foreach ($result as $row) {
            $persen = $row->target > 0 ? round(($row->capaian / $row->target) * 100, 2) : 0;
            $data[] = [
                'label' => 'RW ' . str_pad($row->rw, 2, '0', STR_PAD_LEFT),
                'persentase' => $persen
            ];
        }
        return $this->response->setJSON($data);
    }

    /**
     * 🎯 DISTRIBUSI PROGRES RT
     */
    public function getDistribusiRt()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $dusun = $this->request->getGet('dusun');

        // Memanfaatkan fungsi dari DhkpModel22 yang sudah sangat bagus
        $dataRt = $this->dhkp->setoranPerRtFiltered($dusun, null, null, $tahun);

        $distribusi = [
            'lunas'    => 0, // 100%
            'hampir'   => 0, // 75% - 99%
            'setengah' => 0, // 50% - 74%
            'kurang'   => 0, // 25% - 49%
            'minim'    => 0  // 0% - 24%
        ];

        foreach ($dataRt as $rt) {
            $p = $rt->dataPersentase;
            if ($p >= 100) {
                $distribusi['lunas']++;
            } elseif ($p >= 75) {
                $distribusi['hampir']++;
            } elseif ($p >= 50) {
                $distribusi['setengah']++;
            } elseif ($p >= 25) {
                $distribusi['kurang']++;
            } else {
                $distribusi['minim']++;
            }
        }

        return $this->response->setJSON([
            'total_rt' => count($dataRt),
            'distribusi' => $distribusi
        ]);
    }

    /**
     * 📊 CHART PROGRES PER RT
     */
    public function getProgressRt()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $dusun = $this->request->getGet('dusun');
        $rw    = $this->request->getGet('rw');

        // Mengambil data menggunakan fungsi yang sudah ada di DhkpModel22
        $dataRt = $this->dhkp->setoranPerRtFiltered($dusun, $rw, null, $tahun);

        // Urutkan berdasarkan Dusun, RW, lalu RT
        usort($dataRt, function ($a, $b) {
            if ($a->dusun != $b->dusun) return $a->dusun <=> $b->dusun;
            if ($a->rw != $b->rw) return $a->rw <=> $b->rw;
            return $a->rt <=> $b->rt;
        });

        $data = [];
        foreach ($dataRt as $row) {
            $data[] = [
                'label' => 'RT ' . str_pad($row->rt, 3, '0', STR_PAD_LEFT) . '/RW ' . str_pad($row->rw, 3, '0', STR_PAD_LEFT),
                'persentase' => round($row->dataPersentase, 2)
            ];
        }
        return $this->response->setJSON($data);
    }
}
