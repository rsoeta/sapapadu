<?= $this->extend('pbb/templates/index'); ?>
<?= $this->section('content'); ?>

<style>
    .kpi-card {
        border-radius: 12px;
        padding: 20px;
        color: white;
        margin: 2px 0;
    }

    .bg-primary {
        background: #3b82f6;
    }

    .bg-success {
        background: #22c55e;
    }

    .bg-warning {
        background: #f59e0b;
    }

    .bg-danger {
        background: #ef4444;
    }
</style>

<div class="content-wrapper">
    <div class="container-fluid">

        <!-- 🔥 KPI -->
        <div class="row mt-3">
            <div class="col-md-3 col-6">
                <div class="kpi-card bg-primary">
                    <small>Total Target</small>
                    <h4 id="kpiTarget">Rp <?= number_format($kpi['target']) ?></h4>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="kpi-card bg-success">
                    <small>Capaian</small>
                    <h4 id="kpiCapaian">Rp <?= number_format($kpi['capaian']) ?></h4>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="kpi-card bg-warning">
                    <small>Persentase</small>
                    <h4 id="kpiPersentase"><?= number_format($kpi['persentase'], 2) ?>%</h4>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="kpi-card bg-danger">
                    <small>Sisa</small>
                    <h4 id="kpiSisa">Rp <?= number_format($kpi['sisa']) ?></h4>
                </div>
            </div>
        </div>

        <!-- 🔍 FILTER -->
        <div class="row mt-3">
            <div class="col-md-3 col-6">
                <select id="filterTahun" class="form-control">
                    <option value="">Semua Tahun</option>
                </select>
            </div>
            <div class="col-md-3 col-6">
                <select id="filterDusun" class="form-control">
                    <option value="">Semua Dusun</option>
                </select>
            </div>
            <div class="col-md-3 col-6">
                <select id="filterRw" class="form-control">
                    <option value="">Semua RW</option>
                </select>
            </div>
            <div class="col-md-3 col-6">
                <select id="filterRt" class="form-control">
                    <option value="">Semua RT</option>
                </select>
            </div>
        </div>

        <!-- 📊 CHART -->
        <div class="row mt-4">
            <div class="col-md-6">
                <canvas id="progressChart"></canvas>
            </div>
            <div class="col-md-6">
                <canvas id="timelineChart"></canvas>
            </div>
        </div>

        <!-- 🏆 RANKING -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        🔥 Top 10 RT
                    </div>
                    <ul id="topList" class="list-group">
                        <?php foreach (array_slice($setoranPerRt, 0, 10) as $row): ?>
                            <li class="list-group-item">
                                RT <?= $row->rt ?> - <?= number_format($row->dataPersentase, 2) ?>%
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        ⚠️ Bottom 10 RT
                    </div>
                    <ul id="bottomList" class="list-group">
                        <?php foreach (array_slice(array_reverse($setoranPerRt), 0, 10) as $row): ?>
                            <li class="list-group-item">
                                RT <?= $row->rt ?> - <?= number_format($row->dataPersentase, 2) ?>%
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CHART -->
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
        loadTimeline(); // 🔥 TAMBAH INI
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

        // 🔥 update donut
        progressChart.data.datasets[0].data = [data.persentase, 100 - data.persentase];
        progressChart.update();
    }

    /* =========================
       🏆 RANKING RT
    ========================= */
    async function loadRanking() {

        let tahun = $('#filterTahun').val() || new Date().getFullYear();

        const res = await fetch(`/dashboard/ranking-rt?tahun=${tahun}`);
        const data = await res.json();

        // 🔥 SORT (safety)
        // data.sort((a, b) => b.dataPersentase - a.dataPersentase);
        if (!Array.isArray(data)) {
            console.log('ERROR API:', data);
            return;
        }

        // TOP
        let topHtml = '';
        data.slice(0, 10).forEach(r => {

            let p = Number(r.dataPersentase || 0);
            let color = p >= 80 ? 'green' : p >= 50 ? 'orange' : 'red';

            // 🔥 fallback aman
            let rt = r.rt_fix || pad(r.rt);
            let rw = r.rw_fix || pad(r.rw);

            topHtml += `
            <li class="list-group-item">
                RT ${rt}/RW ${rw}
                <br><small>${r.alamat_rt || ''}</small>
                <span style="float:right;color:${color}">
                    ${p.toFixed(2)}%
                </span>
            </li>`;
            console.log('ranking data:', data);
        });

        $('#topList').html(topHtml);

        // BOTTOM
        let bottomHtml = '';
        data.slice(-10).reverse().forEach(r => {

            let p = Number(r.dataPersentase || 0);
            let color = p >= 80 ? 'green' : p >= 50 ? 'orange' : 'red';

            let rt = r.rt_fix || pad(r.rt);
            let rw = r.rw_fix || pad(r.rw);

            bottomHtml += `
            <li class="list-group-item">
                RT ${rt}/RW ${rw}
                <br><small>${r.alamat_rt || ''}</small>
                <span style="float:right;color:${color}">
                    ${p.toFixed(2)}%
                </span>
            </li>`;
            console.log('ranking data:', data);
        });

        $('#bottomList').html(bottomHtml);
    }

    /* =========================
       📊 CHART KOMPOSISI
    ========================= */
    async function loadChart() {

        let tahun = $('#filterTahun').val() || new Date().getFullYear();

        const res = await fetch(`/dashboard/komposisi?tahun=${tahun}`);
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
       📈 CHART TIMELINE
    ========================= */
    async function loadTimeline() {

        let tahun = $('#filterTahun').val() || new Date().getFullYear();

        const res = await fetch(`/dashboard/timeline?tahun=${tahun}`);
        const data = await res.json();

        let labels = data.map(x => x.tanggal);
        let values = data.map(x => Number(x.total));

        timelineChart.data.labels = labels;
        timelineChart.data.datasets[0].data = values;
        timelineChart.update();
    }

    // 🔥 Custom plugin: label persen di dalam pie
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
            ctx.font = 'bold 12px sans-serif';
            ctx.fillStyle = '#ffffff';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            meta.data.forEach((arc, i) => {
                const value = dataset.data[i];

                // 🔥 skip kalau 0 biar bersih
                if (!value || value <= 0) return;

                const pos = arc.tooltipPosition();

                ctx.fillText(value.toFixed(1) + '%', pos.x, pos.y);
            });

            ctx.restore();
        }
    };
    /* =========================
       📊 INIT CHART
    ========================= */
    function initChart() {

        const ctx = document.getElementById('progressChart');

        progressChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Lunas', 'Belum', 'Bermasalah'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: [
                        '#27ae60', // hijau
                        '#f39c12', // kuning
                        '#e74c3c' // merah
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.raw.toFixed(2) + '%';
                            }
                        }
                    }
                }
            },
            plugins: [piePercentLabel] // 🔥 INI WAJIB
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
       📅 LOAD TAHUN
    ========================= */
    function loadTahun() {
        $.get('/api/wilayah/tahun', function(res) {

            let html = '<option value="">Semua Tahun</option>';

            res.forEach(r => {
                html += `<option value="${r.tahun}">${r.tahun}</option>`;
            });

            $('#filterTahun').html(html);

            // 🔥 default tahun sekarang
            let t = new Date().getFullYear();
            $('#filterTahun').val(t);

            loadAll();
        });
    }

    /* =========================
       📍 LOAD DUSUN
    ========================= */
    function loadDusun() {
        $.get('/api/wilayah/dusun', function(res) {

            let html = '<option value="">Semua Dusun</option>';

            res.forEach(r => {
                html += `<option value="${r.dusun}">
                            Dusun ${r.dusun} - ${r.nama}
                        </option>`;
            });

            $('#filterDusun').html(html);
        });
    }

    /* =========================
       💰 FORMAT
    ========================= */
    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    /* =========================
        📈 INIT CHART TIMELINE
    ========================= */
    function initTimeline() {
        const ctx = document.getElementById('timelineChart');

        timelineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Setoran',
                    data: []
                }]
            }
        });
    }

    /* =========================
       🏆 RANKING RT (PALING PENTING)
    ========================= */
    function pad(num) {
        return String(num).padStart(3, '0');
    }
</script>

<?= $this->endSection(); ?>