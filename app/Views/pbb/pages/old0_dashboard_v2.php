<?= $this->extend('pbb/templates/index'); ?>
<?= $this->section('content'); ?>

<style>
    /* Elegan Font & Layouts - Mengadaptasi Quicksand & Tailwind Feel */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');

    .content-wrapper {
        font-family: 'Quicksand', sans-serif;
        background-color: #f8fafc;
    }

    /* KPI Cards Styling */
    .kpi-card {
        border-radius: 16px;
        padding: 24px 20px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .kpi-card small {
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        opacity: 0.9;
    }

    .kpi-card h4 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-top: 10px;
        margin-bottom: 0;
    }

    /* Modern Gradients */
    .bg-primary-elegant {
        background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
    }

    .bg-success-elegant {
        background: linear-gradient(135deg, #22c55e 0%, #15803d 100%);
    }

    .bg-warning-elegant {
        background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%);
    }

    .bg-danger-elegant {
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
    }

    /* Custom Input Select */
    .custom-select-elegant {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 10px 15px;
        height: auto !important;
        /* Mencegah teks terpotong oleh tinggi bawaan form-control Bootstrap */
        font-weight: 600;
        color: #334155 !important;
        /* Memaksa teks berwarna gelap agar kontras dengan background */
        background-color: #ffffff;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
        appearance: auto;
        /* Memastikan icon panah dropdown tetap muncul */
    }

    .custom-select-elegant:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.2);
        outline: none;
    }

    /* Card & Chart Containers */
    .elegant-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .elegant-card-header {
        padding: 16px 20px;
        font-weight: 700;
        font-size: 1.1rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
        padding: 20px;
    }

    /* Scrollable Lists */
    .custom-list-group {
        max-height: 350px;
        overflow-y: auto;
        padding: 10px;
    }

    .custom-list-item {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s;
        border-radius: 8px;
    }

    .custom-list-item:hover {
        background-color: #f8fafc;
    }

    .badge-percent {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* Scrollbar */
    .custom-list-group::-webkit-scrollbar {
        width: 6px;
    }

    .custom-list-group::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .custom-list-group::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .custom-list-group::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="kpi-card bg-primary-elegant">
                    <small><i class="fa-solid fa-bullseye"></i> Total Target</small>
                    <h4 id="kpiTarget">Rp 0</h4>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="kpi-card bg-success-elegant">
                    <small><i class="fa-solid fa-wallet"></i> Capaian</small>
                    <h4 id="kpiCapaian">Rp 0</h4>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="kpi-card bg-warning-elegant">
                    <small><i class="fa-solid fa-chart-pie"></i> Persentase</small>
                    <h4 id="kpiPersentase">0.00%</h4>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="kpi-card bg-danger-elegant">
                    <small><i class="fa-solid fa-file-invoice-dollar"></i> Sisa Target</small>
                    <h4 id="kpiSisa">Rp 0</h4>
                </div>
            </div>
        </div>

        <div class="row mb-4 mt-2">
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">Tahun</label>
                <select id="filterTahun" class="form-control custom-select-elegant">
                    <option value="">Semua Tahun</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">Dusun</label>
                <select id="filterDusun" class="form-control custom-select-elegant">
                    <option value="">Semua Dusun</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">RW</label>
                <select id="filterRw" class="form-control custom-select-elegant">
                    <option value="">Semua RW</option>
                </select>
            </div>
            <div class="col-md-3 col-6 mb-2">
                <label class="text-xs font-weight-bold text-muted text-uppercase mb-1">RT</label>
                <select id="filterRt" class="form-control custom-select-elegant">
                    <option value="">Semua RT</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="elegant-card h-100">
                    <div class="elegant-card-header text-dark">
                        <i class="fa-solid fa-chart-pie text-primary"></i> Komposisi Pembayaran
                    </div>
                    <div class="chart-container">
                        <canvas id="progressChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="elegant-card h-100">
                    <div class="elegant-card-header text-dark">
                        <i class="fa-solid fa-chart-area text-purple"></i> Timeline Setoran
                    </div>
                    <div class="chart-container">
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="elegant-card">
                    <div class="elegant-card-header text-white" style="background: linear-gradient(90deg, #10b981, #059669);">
                        <i class="fa-solid fa-trophy text-warning"></i> Top 10 RT Tertinggi
                    </div>
                    <ul id="topList" class="list-group custom-list-group">
                        <li class="custom-list-item text-center text-muted">Memuat data...</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="elegant-card">
                    <div class="elegant-card-header text-white" style="background: linear-gradient(90deg, #ef4444, #dc2626);">
                        <i class="fa-solid fa-triangle-exclamation text-warning"></i> Bottom 10 RT Terendah
                    </div>
                    <ul id="bottomList" class="list-group custom-list-group">
                        <li class="custom-list-item text-center text-muted">Memuat data...</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let progressChart = null;
    let timelineChart = null;

    $(document).ready(function() {
        initChart();
        initTimeline();
        loadTahun();
        loadDusun();
    });

    /* =========================
       🔥 LOAD SEMUA DATA
    ========================= */
    function loadAll() {
        loadKpi();
        loadRanking();
        loadChart();
        loadTimeline();
    }

    /* =========================
       🎯 KPI (DHKP BASED)
    ========================= */
    async function loadKpi() {
        let tahun = $('#filterTahun').val() || new Date().getFullYear();
        let dusun = $('#filterDusun').val() || '';
        let rw = $('#filterRw').val() || '';
        let rt = $('#filterRt').val() || '';

        const res = await fetch(`/dashboard/kpi?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();

        $('#kpiTarget').text(formatRupiah(data.target));
        $('#kpiCapaian').text(formatRupiah(data.capaian));
        $('#kpiPersentase').text(data.persentase + '%');
        $('#kpiSisa').text(formatRupiah(data.sisa));

        // PERBAIKAN: Pembaruan progressChart dihapus dari sini agar tidak bentrok dengan loadChart()
    }

    /* =========================
       🏆 RANKING RT
    ========================= */
    async function loadRanking() {
        let tahun = $('#filterTahun').val() || new Date().getFullYear();
        // Ranking biasanya bersifat global tahunan, jika API butuh dusun dll, bisa ditambahkan parameternya
        const res = await fetch(`/dashboard/ranking-rt?tahun=${tahun}`);
        const data = await res.json();

        if (!Array.isArray(data)) return;

        data.sort((a, b) => b.dataPersentase - a.dataPersentase);

        let topHtml = '';
        data.slice(0, 10).forEach((r, idx) => {
            let p = Number(r.dataPersentase || 0);
            let bgClass = p >= 80 ? 'background: #dcfce7; color: #166534;' : p >= 50 ? 'background: #fef9c3; color: #854d0e;' : 'background: #fee2e2; color: #991b1b;';
            let rt = r.rt_fix || pad(r.rt);
            let rw = r.rw_fix || pad(r.rw);

            topHtml += `
            <li class="custom-list-item">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:30px; height:30px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-weight:bold; color:#64748b; margin-right:15px;">${idx + 1}</div>
                    <div>
                        <strong style="color:#334155;">RT ${rt} / RW ${rw}</strong>
                        <div style="font-size: 0.8rem; color:#64748b;">${r.alamat_rt || '-'}</div>
                    </div>
                </div>
                <span class="badge-percent" style="${bgClass}">
                    ${p.toFixed(2)}%
                </span>
            </li>`;
        });
        $('#topList').html(topHtml || '<li class="custom-list-item text-center text-muted">Belum ada data.</li>');

        let bottomHtml = '';
        data.slice(-10).reverse().forEach((r, idx) => {
            let p = Number(r.dataPersentase || 0);
            let bgClass = p >= 80 ? 'background: #dcfce7; color: #166534;' : p >= 50 ? 'background: #fef9c3; color: #854d0e;' : 'background: #fee2e2; color: #991b1b;';
            let rt = r.rt_fix || pad(r.rt);
            let rw = r.rw_fix || pad(r.rw);

            bottomHtml += `
            <li class="custom-list-item">
                 <div class="d-flex align-items-center gap-3">
                    <div style="width:30px; height:30px; border-radius:50%; background:#f1f5f9; display:flex; align-items:center; justify-content:center; font-weight:bold; color:#64748b; margin-right:15px;">${idx + 1}</div>
                    <div>
                        <strong style="color:#334155;">RT ${rt} / RW ${rw}</strong>
                        <div style="font-size: 0.8rem; color:#64748b;">${r.alamat_rt || '-'}</div>
                    </div>
                </div>
                <span class="badge-percent" style="${bgClass}">
                    ${p.toFixed(2)}%
                </span>
            </li>`;
        });
        $('#bottomList').html(bottomHtml || '<li class="custom-list-item text-center text-muted">Belum ada data.</li>');
    }

    /* =========================
       📊 CHART KOMPOSISI (FIX DINAMIS)
    ========================= */
    async function loadChart() {
        let tahun = $('#filterTahun').val() || new Date().getFullYear();
        let dusun = $('#filterDusun').val() || '';
        let rw = $('#filterRw').val() || '';
        let rt = $('#filterRt').val() || '';

        // PERBAIKAN: Menambahkan parameter filter ke endpoint API
        const res = await fetch(`/dashboard/komposisi?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();

        let total = (data.lunas || 0) + (data.belum || 0) + (data.bermasalah || 0);

        if (total === 0) {
            progressChart.data.datasets[0].data = [0, 0, 0];
        } else {
            progressChart.data.datasets[0].data = [
                (data.lunas / total * 100),
                (data.belum / total * 100),
                (data.bermasalah / total * 100)
            ];
        }

        progressChart.update();
    }

    /* =========================
       📈 CHART TIMELINE (FIX DINAMIS)
    ========================= */
    async function loadTimeline() {
        let tahun = $('#filterTahun').val() || new Date().getFullYear();
        let dusun = $('#filterDusun').val() || '';
        let rw = $('#filterRw').val() || '';
        let rt = $('#filterRt').val() || '';

        // PERBAIKAN: Menambahkan parameter filter ke endpoint API
        const res = await fetch(`/dashboard/timeline?tahun=${tahun}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
        const data = await res.json();

        let labels = data.map(x => x.tanggal);
        let values = data.map(x => Number(x.total));

        timelineChart.data.labels = labels;
        timelineChart.data.datasets[0].data = values;
        timelineChart.update();
    }

    // Plugin Persen (Tetap Dipertahankan)
    const piePercentLabel = {
        id: 'piePercentLabel',
        afterDraw(chart) {
            const {
                ctx
            } = chart;
            const dataset = chart.data.datasets[0];
            const meta = chart.getDatasetMeta(0);
            if (!dataset || !meta) return;

            ctx.save();
            ctx.font = 'bold 13px Quicksand, sans-serif';
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            meta.data.forEach((arc, i) => {
                const value = dataset.data[i];
                if (!value || value <= 0) return;
                const pos = arc.tooltipPosition();
                ctx.fillText(value.toFixed(1) + '%', pos.x, pos.y);
            });
            ctx.restore();
        }
    };

    /* =========================
       📊 INIT CHART (ESTETIKA LANDING.PHP)
    ========================= */
    function initChart() {
        const ctx = document.getElementById('progressChart');
        progressChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Lunas', 'Belum Lunas', 'Bermasalah'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: ['#0ea5e9', '#a855f7', '#f43f5e'], // Palet dari landing.php
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: 'Quicksand',
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            },
            plugins: [piePercentLabel]
        });
    }

    /* =========================
        📈 INIT CHART TIMELINE (ESTETIKA LANDING.PHP)
    ========================= */
    function initTimeline() {
        const ctx = document.getElementById('timelineChart');
        timelineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Setoran',
                    data: [],
                    borderColor: '#9333ea',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    borderWidth: 3,
                    tension: 0.4, // Kurva mulus
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#9333ea',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [4, 4],
                            color: '#f1f5f9'
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Quicksand'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Quicksand'
                            }
                        }
                    }
                }
            }
        });
    }

    /* =========================
       🔍 FILTER WILAYAH
    ========================= */
    $('#filterDusun').change(function() {
        let dusun = $(this).val();
        $.get('/api/wilayah/rw', {
            dusun
        }, function(res) {
            let html = '<option value="">Semua RW</option>';
            res.forEach(r => {
                html += `<option value="${r.rw}">RW ${String(r.rw).padStart(3,'0')}</option>`;
            });
            $('#filterRw').html(html);
            $('#filterRt').html('<option value="">Semua RT</option>');
            loadAll();
        });
    });

    $('#filterRw').change(function() {
        let dusun = $('#filterDusun').val();
        let rw = $(this).val();
        $.get('/api/wilayah/rt', {
            dusun,
            rw
        }, function(res) {
            let html = '<option value="">Semua RT</option>';
            res.forEach(r => {
                html += `<option value="${r.rt}">RT ${String(r.rt).padStart(3,'0')}</option>`;
            });
            $('#filterRt').html(html);
            loadAll();
        });
    });

    $('#filterRt, #filterTahun').change(function() {
        loadAll();
    });

    /* =========================
       📅 LOAD TAHUN & DUSUN
    ========================= */
    function loadTahun() {
        $.get('/api/wilayah/tahun', function(res) {
            let html = '<option value="">Semua Tahun</option>';
            res.forEach(r => {
                html += `<option value="${r.tahun}">${r.tahun}</option>`;
            });
            $('#filterTahun').html(html);
            let t = new Date().getFullYear();
            $('#filterTahun').val(t);
            loadAll();
        });
    }

    function loadDusun() {
        $.get('/api/wilayah/dusun', function(res) {
            let html = '<option value="">Semua Dusun</option>';
            res.forEach(r => {
                html += `<option value="${r.dusun}">Dusun ${r.dusun} - ${r.nama}</option>`;
            });
            $('#filterDusun').html(html);
        });
    }

    /* =========================
       💰 UTILS
    ========================= */
    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function pad(num) {
        return String(num).padStart(3, '0');
    }
</script>

<?= $this->endSection(); ?>