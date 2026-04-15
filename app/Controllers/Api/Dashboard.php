<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $DhkpModel22;
    protected $TrxModel22;

    public function __construct()
    {
        $this->DhkpModel22 = new \App\Models\Pbb\DhkpModel22();
        $this->TrxModel22 = new \App\Models\Pbb\TrxModel22();
    }

    public function index()
    {
        $dusun = $this->request->getGet('dusun');
        $rw = $this->request->getGet('rw');
        $rt = $this->request->getGet('rt');
        $tahun = $this->request->getGet('tahun');

        // 🔥 NORMALISASI TOTAL
        $dusun = (!empty($dusun) && $dusun !== 'Semua Dusun') ? $dusun : null;
        $rw = (!empty($rw) && $rw !== 'Semua RW') ? $rw : null;
        $rt = (!empty($rt) && $rt !== 'Semua RT') ? $rt : null;
        $tahun = $tahun ?: null;

        try {

            // $data = $this->DhkpModel22->filterWilayah($dusun, $rw, $rt, $tahun);
            $data = $this->DhkpModel22->setoranPerRtFiltered($dusun, $rw, $rt, $tahun);
            $timeline = $this->TrxModel22->timelineChartFiltered($dusun, $rw, $rt, $tahun);

            // dd($builder->getCompiledSelect());

            $totalTarget = array_sum(array_column($data, 'dataTarget'));
            $totalCapaian = array_sum(array_column($data, 'dataCapaian'));

            $persen = $totalTarget > 0 ? ($totalCapaian / $totalTarget) * 100 : 0;

            return $this->response->setJSON([
                'kpi' => [
                    'target' => $totalTarget,
                    'capaian' => $totalCapaian,
                    'persentase' => $persen,
                    'sisa' => $totalTarget - $totalCapaian
                ],
                'timeline' => array_values($timeline),
                'ranking' => [
                    'top' => array_slice($data, 0, 10),
                    'bottom' => array_slice(array_reverse($data), 0, 10)
                ]
            ]);
        } catch (\Throwable $e) {

            return $this->response->setJSON([
                'error' => $e->getMessage()
            ]);
        }
    }
}
