<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    .description-text {
        font-weight: bold;
    }
</style>
<script src="<?= base_url('assets/plugins/chart.js/3.7.0/chart.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <section class="content">
        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Diagram Target dan Capaian
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#thread-kecamatan" data-toggle="tab">Tingkat Kecamatan</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#thread-desa" data-toggle="tab">Tingkat Desa</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link active" href="#thread-dusun" data-toggle="tab">Tingkat Dusun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#thread_rw" data-toggle="tab">Tingkat RW</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#thread_rt" data-toggle="tab">Tingkat RT</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">

                    <div class="chart tab-pane active" id="thread-dusun">
                        <div class="row">
                            <div class="col-12 col-sm-8 col-md-7">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Tabel Per-Dusun</h3>
                                    </div>

                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">No.</th>
                                                    <th>Dusun</th>
                                                    <th>Target</th>
                                                    <th>Capaian</th>
                                                    <th>Progres</th>
                                                    <th style="width: 40px">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($setoranPerDusun as $row) { ?>
                                                    <tr>
                                                        <td style="text-align: center;"><?= $i; ?></td>
                                                        <td style="text-align: center;"><?= sprintf('%03d', $row->dusun); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataTarget, 0, ',', '.'); ?></td>
                                                        <td style="text-align: right;"><?= 'Rp. ' . number_format($row->dataCapaian, 0, ',', '.'); ?></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?= $row->dataPersentase; ?>%"></div>
                                                            </div>
                                                        </td>
                                                        <td><span class="badge bg-primary"><?= number_format($row->dataPersentase, 2, '.', ','); ?>%</span></td>
                                                    </tr>
                                                    <?php $i++ ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-5">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Stacked Bar Chart</h3>
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
                                            <canvas id="stackedBarChart" style="min-height: 250px; height: 350px; max-height: 500px; max-width: 100%; display: block; width: 329px;" width="658" height="500" class="chartjs-render-monitor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        // Ambil data dari PHP
        const data = <?= json_encode($setoranPerDusun) ?>;

        // Ekstrak label dan data dari data yang diterima
        var labels = <?= json_encode(array_column($setoranPerDusun, 'dusun')) ?>;
        var capaianData = <?= json_encode(array_column($setoranPerDusun, 'dataPersentase')) ?>;
        var sisaData = <?= json_encode(array_column($setoranPerDusun, 'dataSisaPersentase')) ?>;

        // Setup Chart.js
        const ctx = document.getElementById('stackedBarChart').getContext('2d');
        const myChart = new Chart(ctx, {
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
<?= $this->endSection(); ?>