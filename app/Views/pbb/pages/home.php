<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<script src="<?= base_url('assets/plugins/chart.js/chartjs-plugin-labels.min.js'); ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->

        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Chart Target dan Setor
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#thread-desa" data-toggle="tab">Desa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#thread-dusun" data-toggle="tab">Per-Dusun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#thread_rw" data-toggle="tab">Per-RW</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#thread_rt" data-toggle="tab">Per-RT</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="thread-desa">
                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-12">
                                <h4 class="text-center">
                                    <strong>Chart Desa</strong>
                                </h4>
                                <canvas id="thread-desa-canvas" style="width:10px !important; height:6px !important;"></canvas>
                                <div class="card-footer">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" scope="col">#</th>
                                                <th colspan="3">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Target</th>
                                                <?php foreach ($setoranPerDesa as $row) : ?>
                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak1']); ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                            <tr>
                                                <th>Setoran</th>
                                                <?php foreach ($setoranPerDesa as $row) : ?>
                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak0']); ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                            <tr>
                                                <th>SPPT Bermasalah</th>
                                                <?php foreach ($setoranPerDesa as $row) : ?>
                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak2']); ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Selisih</th>
                                                <?php foreach ($setoranPerDesa as $row) : ?>
                                                    <th class="text-right bold" scope="col">Rp. <?= number_format(($row['pajak1'] - $row['pajak0']) - $row['pajak2']); ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="col">
                                    <h4 class="text-center">
                                        <strong>Persentase</strong>
                                    </h4>
                                    <?php
                                    $nomor = 0;
                                    foreach ($setoranPerDesa as $row) : $nomor++ ?>

                                        <div class="progress-group">
                                            <span class="float-right"><b><?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . '%'; ?></b></span>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: <?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . "%"; ?>"></div>
                                            </div>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="thread-dusun">
                        <div class="row">
                            <div class="col-sm-8 col-12">
                                <h4 class="text-center">
                                    <strong>Chart Per-Dusun</strong>
                                </h4>
                                <canvas id="thread-dusun-canvas" height="10%" style="height: 25px; display: block; width: 100px;" width="25%" class="chartjs-render-monitor"></canvas>
                                <div class="card-footer">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" scope="col">#</th>
                                                <th colspan="3">Dusun</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($setoranPerDusun as $row) : ?>
                                                    <th scope="col"><?= $row['dusun']; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Target</th>
                                                <?php foreach ($setoranPerDusun as $row) : ?>
                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak1']); ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                            <tr>
                                                <th>Setoran</th>
                                                <?php foreach ($setoranPerDusun as $row) : ?>
                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak0']); ?></td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Selisih</th>
                                                <?php foreach ($setoranPerDusun as $row) : ?>
                                                    <th class="text-right bold" scope="col">Rp. <?= number_format($row['pajak1'] - $row['pajak0']); ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <div class="col">
                                    <h4 class="text-center">
                                        <strong>Persentase</strong>
                                    </h4>
                                    <?php
                                    $nomor = 0;
                                    foreach ($setoranPerDusun as $row) : $nomor++ ?>

                                        <div class="progress-group">
                                            Dusun <?php echo $row['dusun']; ?>
                                            <span class="float-right"><b><?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . '%'; ?></b></span>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: <?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . "%"; ?>"></div>
                                            </div>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane" id="thread_rw">
                        <div class="row">
                            <div class="col-sm-8 col-12">
                                <h4 class="text-center">
                                    <strong>Chart Per-RW</strong>
                                </h4>
                                <canvas id="thread-rw-canvas" height="10%" style="height: 100px; display: block; width: 100px;" width="25%" class="chartjs-render-monitor"></canvas>
                                <div class="card-footer">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th rowspan="2" scope="col">#</th>
                                                <th colspan="6">No. RW</th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($setoranPerRw as $row) : ?>

                                                    <th scope="col"><?= $row['rw']; ?></th>

                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Target</th>
                                                <?php foreach ($setoranPerRw as $row) : ?>

                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak1']); ?></td>

                                                <?php endforeach ?>
                                            </tr>
                                            <tr>
                                                <th>Setoran</th>
                                                <?php foreach ($setoranPerRw as $row) : ?>

                                                    <td class="text-right" scope="col">Rp. <?= number_format($row['pajak0']); ?></td>

                                                <?php endforeach ?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Selisih</th>
                                                <?php foreach ($setoranPerRw as $row) : ?>

                                                    <th class="text-right bold" scope="col">Rp. <?= number_format($row['pajak1'] - $row['pajak0']); ?></th>

                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4 col-12">
                                <h4 class="text-center">
                                    <strong>Persentase</strong>
                                </h4>
                                <?php
                                foreach ($setoranPerRw as $row) : ?>

                                    <div class="progress-group">
                                        RW <?php echo $row['rw']; ?>
                                        <span class="float-right"><b><?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . '%'; ?></b></span>
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" style="width: <?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . "%"; ?>"></div>
                                        </div>
                                    </div>

                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="chart tab-pane " id="thread_rt">
                        <div class="col-12">
                            <h4 class="text-center">
                                <strong>Chart Per-RT</strong>
                            </h4>
                            <canvas id="thread-rt-canvas" height="5%" style="height: 100px; display: block; width: 100px;" width="25%" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="col-12">
                            <h4 class="text-center">
                                <strong>Persentase</strong>
                            </h4>

                            <div class="container-fluid text-center">
                                <?php foreach ($setoranPerRt as $row) : ?>
                                    <!-- <div class="progress-group"> -->
                                    <div class="mb-2 mr-2" role="progressbar" aria-valuenow="<?php echo round(($row['pajak0'] / $row['pajak1']) * 100) ?>" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo round(($row['pajak0'] / $row['pajak1']) * 100) ?>">
                                        <?php echo $row['rt'] . ' / ' . $row['rw'] ?>
                                    </div>
                                    <!-- </div> -->
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.card-body -->
    </section>
</div>
<script src="<?= base_url('assets/plugins/chart.js/3.7.0/chart.min.js'); ?>"></script>
<script>
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

    // setup 
    const data_desa = {
        labels: [
            <?php foreach ($setoranPerDesa  as $row) : ?>
            <?php endforeach ?>
        ],
        datasets: [{
                label: 'Target',
                data: [
                    <?php
                    foreach ($setoranPerDesa  as $row) : ?>
                        <?php echo '"' . $row['pajak1'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Capaian',
                data: [
                    <?php
                    foreach ($setoranPerDesa  as $row) : ?>
                        <?php echo '"' . $row['pajak0'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }
        ]
    };

    // config 
    const config_desa = {
        type: 'pie',
        data: data_desa,
        options: {
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data_desa) {
                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            },
        }
    };

    // render init block
    const chartDesa = new Chart(
        document.getElementById('thread-desa-canvas'),
        config_desa
    );
    // setup 
    const data_dusun = {
        labels: [
            <?php foreach ($setoranPerDusun  as $row) : ?>
                <?php echo '"Dusun ' . $row['dusun'] . '",'; ?>
            <?php endforeach ?>
        ],
        datasets: [{
                label: 'Target',
                data: [
                    <?php
                    foreach ($setoranPerDusun  as $row) : ?>
                        <?php echo '"' . $row['pajak1'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Capaian',
                data: [
                    <?php
                    foreach ($setoranPerDusun  as $row) : ?>
                        <?php echo '"' . $row['pajak0'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }
        ]
    };

    // config 
    const config = {
        type: 'bar',
        data: data_dusun,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data_dusun) {
                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
    };

    // render init block
    const chartDusun = new Chart(
        document.getElementById('thread-dusun-canvas'),
        config
    );

    // setup 
    const data_rw = {
        labels: [
            <?php foreach ($setoranPerRw  as $row) : ?>
                <?php echo '"Rw ' . $row['rw'] . '",'; ?>
            <?php endforeach ?>
        ],
        datasets: [{
                label: 'Target',
                data: [
                    <?php
                    foreach ($setoranPerRw  as $row) : ?>
                        <?php echo '"' . $row['pajak1'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Capaian',
                data: [
                    <?php
                    foreach ($setoranPerRw  as $row) : ?>
                        <?php echo '"' . $row['pajak0'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }
        ]
    };

    // config 
    const config_rw = {
        type: 'bar',
        data: data_rw,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data_rw) {
                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
    };
    // render init block
    const chartRw = new Chart(
        document.getElementById('thread-rw-canvas'),
        config_rw
    );


    // setup data_rt
    const data_rt = {
        labels: [
            <?php foreach ($setoranPerRt  as $row) : ?>
                <?php echo '"RT/RW ' . $row['rt'] . '/' . $row['rw'] . '",'; ?>
            <?php endforeach ?>
        ],
        datasets: [{
                label: 'Target',
                data: [
                    <?php
                    foreach ($setoranPerRt  as $row) : ?>
                        <?php echo '"' . $row['pajak1'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            },
            {
                label: 'Capaian',
                data: [
                    <?php
                    foreach ($setoranPerRt  as $row) : ?>
                        <?php echo '"' . $row['pajak0'] . '",'; ?>
                    <?php endforeach ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }
        ]
    };

    // config 
    const config_rt = {
        type: 'bar',
        data: data_rt,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data_rt) {
                        return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                }
            }
        }
    };

    // render init block
    const chartRt = new Chart(
        document.getElementById('thread-rt-canvas'),
        config_rt
    );
</script>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>