<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    .description-text {
        font-weight: bold;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@3.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/date-fns@3.6.0/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/date-fns@3.6.0/locale/id/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <section class="content">

        <!-- <div class="card card-primary card-outline"> -->
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Tab Target dan Capaian
            </h3>
        </div>

        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-timeline-tab" data-toggle="pill" href="#custom-tabs-four-timeline" role="tab" aria-controls="custom-tabs-four-timeline" aria-selected="false">Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="false">Tingkat Dusun</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tingkat RW</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Tingkat RT</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-four-timeline" role="tabpanel" aria-labelledby="custom-tabs-four-timeline-tab">
                        <div class="row">
                            <div class="col-12">

                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Timeline Capaian</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col-12 col-sm-8 form-group row nopadding">
                                            <label for="timeScale" class="col-6 col-sm-3 col-form-label">Pilih Skala Waktu:</label>
                                            <div class="col-6 col-sm-5">
                                                <select id="timeScale" class="form-control form-control">
                                                    <option value="day">Hari</option>
                                                    <option value="week">Minggu</option>
                                                    <option value="month">Bulan</option>
                                                    <option value="year">Tahun</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="chart">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="timelineChart" style="min-height: 250px; height: 350px; max-height: 500px; max-width: 100%; display: block; width: 329px;" width="1000" height="500" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Per-Dusun</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">No.</th>
                                                    <th style="text-align: center;">Dusun</th>
                                                    <th style="text-align: center;">Target</th>
                                                    <th style="text-align: center;">Capaian</th>
                                                    <th style="text-align: center;">Progres</th>
                                                    <th style="text-align: center; width: 20px">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php
                                                $totalTarget = 0;
                                                $totalCapaian = 0;
                                                ?>
                                                <?php foreach ($setoranPerDusun as $row) {
                                                    $totalTarget += $row->dataTarget;
                                                    $totalCapaian += $row->dataCapaian;
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $i; ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->dusun); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataTarget, 0, ',', '.'); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataCapaian, 0, ',', '.'); ?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" style="width: <?= $row->dataPersentase; ?>%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-danger"><?= number_format($row->dataPersentase, 2, '.', ','); ?>%</span></td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                <?php } ?>
                                                <!-- Baris jumlah total -->
                                                <tr>
                                                    <td style="text-align: center;" colspan="2"><strong>Total</strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalTarget, 0, ',', '.'); ?></strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalCapaian, 0, ',', '.'); ?></strong></td>
                                                    <?php $totalPersentase = ($totalCapaian / $totalTarget) * 100 ?>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated" style="width: <?= $totalPersentase; ?>%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-secondary"><?= number_format($totalPersentase, 2, '.', ','); ?>%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 col-sm-5">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Diagram Persentase Per-Dusun</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="dusunChart" style="min-height: 250px; height: 350px; max-height: 500px; max-width: 100%; display: block; width: 329px;" width="1000" height="500" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                        <div class="row">
                            <div class="col-12 col-sm-5 col-md-5">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Per-RW</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">No.</th>
                                                    <th style="text-align: center;">Dusun</th>
                                                    <th style="text-align: center;">RW</th>
                                                    <th style="text-align: center;">Target</th>
                                                    <th style="text-align: center;">Capaian</th>
                                                    <th style="text-align: center;">Progres</th>
                                                    <th style="text-align: center; width: 20px">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php
                                                $totalTarget = 0;
                                                $totalCapaian = 0;
                                                ?>
                                                <?php foreach ($setoranPerRw as $row) {
                                                    $totalTarget += $row->dataTarget;
                                                    $totalCapaian += $row->dataCapaian;
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $i; ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->dusunNama); ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->rwNama); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataTarget, 0, ',', '.'); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataCapaian, 0, ',', '.'); ?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" style="width: <?= $row->dataPersentase; ?>%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-primary"><?= number_format($row->dataPersentase, 2, '.', ','); ?>%</span></td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                <?php } ?>
                                                <!-- Baris jumlah total -->
                                                <tr>
                                                    <td style="text-align: center;" colspan="3"><strong>Total</strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalTarget, 0, ',', '.'); ?></strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalCapaian, 0, ',', '.'); ?></strong></td>
                                                    <?php $totalPersentase = ($totalCapaian / $totalTarget) * 100 ?>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated" style="width: <?= $totalPersentase; ?>%"></div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-secondary"><?= number_format($totalPersentase, 2, '.', ','); ?>%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-7 col-md-7">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Diagram Persentase Per-RW</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="rwChart" style="min-height: 300px; height: 450px; max-height: 500px; max-width: 100%; display: block; width: 329px;" width="1000" height="500" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Per-RT</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <table class="table table-striped" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">No.</th>
                                                    <th style="text-align: center;">Dusun</th>
                                                    <th style="text-align: center;">RW</th>
                                                    <th style="text-align: center;">RT</th>
                                                    <th style="text-align: center;">Target</th>
                                                    <th style="text-align: center;">Capaian</th>
                                                    <th style="text-align: center; width: 20px">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php
                                                $totalTarget = 0;
                                                $totalCapaian = 0;
                                                ?>
                                                <?php foreach ($setoranPerRt as $row) {
                                                    $totalTarget += $row->dataTarget;
                                                    $totalCapaian += $row->dataCapaian;
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $i; ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->dusunNama); ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->rwNama); ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->rtNama); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataTarget, 0, ',', '.'); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataCapaian, 0, ',', '.'); ?></td>
                                                        <td><span class="badge bg-success"><?= number_format($row->dataPersentase, 2, '.', ','); ?>%</span></td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                <?php } ?>
                                                <!-- Baris jumlah total -->
                                                <tr>
                                                    <td style="text-align: center;" colspan="4"><strong>Total</strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalTarget, 0, ',', '.'); ?></strong></td>
                                                    <td style="text-align: right;"><strong><?= 'Rp. ' . number_format($totalCapaian, 0, ',', '.'); ?></strong></td>
                                                    <?php $totalPersentase = ($totalCapaian / $totalTarget) * 100 ?>
                                                    <td><span class="badge bg-secondary"><?= number_format($totalPersentase, 2, '.', ','); ?>%</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-8 col-md-8">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Diagram Persentase Per-RT</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div>
                                            <canvas id="rtChart" style="min-height: 500px; height: 500px; max-height: 750px; max-width: 100%; display: block; width: 400px;" width="1000" height="500" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- </div> -->
    </section>
</div>
<!-- /.card -->
<script>
    // Data setoran dari PHP ke JavaScript
    var dataSetoran = <?= json_encode($timelineChart); ?>;
    console.log('Data setoran:', dataSetoran);

    // Mengambil elemen canvas
    var ctx = document.getElementById('timelineChart').getContext('2d');

    // Fungsi untuk memperbarui data berdasarkan unit waktu
    function aggregateData(timeUnit) {
        var aggregatedLabels = [];
        var aggregatedData = [];
        var map = new Map();

        dataSetoran.forEach(function(setoran) {
            var date = new Date(setoran.tr_tgl);
            var amount = parseFloat(setoran.tr_totalkotor);
            var key;

            if (timeUnit === 'day') {
                key = dateFns.format(date, 'yyyy-MM-dd');
            } else if (timeUnit === 'week') {
                key = dateFns.format(date, 'yyyy-II'); // ISO week
            } else if (timeUnit === 'month') {
                key = dateFns.format(date, 'yyyy-MM');
            } else if (timeUnit === 'year') {
                key = dateFns.format(date, 'yyyy');
            }

            if (map.has(key)) {
                map.set(key, map.get(key) + amount);
            } else {
                map.set(key, amount);
            }
        });

        map.forEach((value, key) => {
            aggregatedLabels.push(key);
            aggregatedData.push(value);
        });

        return {
            labels: aggregatedLabels,
            data: aggregatedData
        };
    }

    // Fungsi untuk memperbarui chart
    function updateChart(timeUnit) {
        console.log('Updating chart with time unit:', timeUnit);

        var aggregated = aggregateData(timeUnit);

        var config = {
            type: 'line',
            data: {
                labels: aggregated.labels,
                datasets: [{
                    label: 'Jumlah Setoran',
                    data: aggregated.data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: timeUnit,
                            tooltipFormat: 'dd-MM-yyyy HH:mm:ss',
                            displayFormats: {
                                day: 'dd-MM-yyyy',
                                week: 'dd-MM-yyyy',
                                month: 'MM-yyyy',
                                year: 'yyyy'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Tanggal'
                        },
                        ticks: {
                            source: 'data'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Setoran'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR'
                                    }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        };

        if (window.myChart) {
            window.myChart.destroy();
        }
        window.myChart = new Chart(ctx, config);
    }

    updateChart('day');

    document.getElementById('timeScale').addEventListener('change', function() {
        var selectedTimeUnit = this.value;
        console.log('Dropdown changed to:', selectedTimeUnit);
        updateChart(selectedTimeUnit);
    });

    $(document).ready(function() {
        $('body').addClass('sidebar-collapse');
        $('.displayNone').css('display', 'none');

        // kode disini
        // Ambil data Dusun
        var data = <?= json_encode($setoranPerDusun) ?>;

        // Ekstrak label dan data dari data yang diterima
        var labels = <?= json_encode(array_column($setoranPerDusun, 'dusun')) ?>;
        var capaianData = <?= json_encode(array_column($setoranPerDusun, 'dataPersentase')) ?>;
        var sisaData = <?= json_encode(array_column($setoranPerDusun, 'dataSisaPersentase')) ?>;

        // Setup Chart.js
        var ctx = document.getElementById('dusunChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Capaian',
                        data: capaianData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sisa',
                        data: sisaData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100
                    }
                },
                responsive: true,
                plugins: {
                    datalabels: {
                        display: true,
                        color: 'black', // Warna font hitam
                        formatter: function(value, context) {
                            return value + '%';
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Ambil data RW
        var data = <?= json_encode($setoranPerRw) ?>;

        // Ekstrak label dan data dari data yang diterima
        var labels = <?= json_encode(array_column($setoranPerRw, 'rwNama')) ?>;
        var capaianData = <?= json_encode(array_column($setoranPerRw, 'dataPersentase')) ?>;
        var sisaData = <?= json_encode(array_column($setoranPerRw, 'dataSisaPersentase')) ?>;

        // Setup Chart.js
        var ctx = document.getElementById('rwChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Capaian',
                        data: capaianData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sisa',
                        data: sisaData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100
                    }
                },
                responsive: true,
                plugins: {
                    datalabels: {
                        display: true,
                        color: 'black', // Warna font hitam
                        formatter: function(value, context) {
                            return value + '%';
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

        // Ambil data RT
        var data = <?= json_encode($setoranPerRt) ?>;

        // Ekstrak label dan data dari data yang diterima
        <?php
        $labels = array_map(function ($item) {
            return sprintf('%02d', $item->rtNama) . ' / ' . sprintf('%02d', $item->rwNama);
        }, $setoranPerRt);
        ?>

        var labels = <?= json_encode($labels) ?>;
        var capaianData = <?= json_encode(array_column($setoranPerRt, 'dataPersentase')) ?>;
        var sisaData = <?= json_encode(array_column($setoranPerRt, 'dataSisaPersentase')) ?>;

        // Setup Chart.js
        var ctx = document.getElementById('rtChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Capaian',
                        data: capaianData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sisa',
                        data: sisaData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        max: 100
                    }
                },
                responsive: true,
                plugins: {
                    datalabels: {
                        display: true,
                        color: 'black', // Warna font hitam
                        formatter: function(value, context) {
                            return value + '%';
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

    });


    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>
<script>
    window.dateFnsLocaleId = dateFns.locale.id;
</script>
<?= $this->endSection(); ?>