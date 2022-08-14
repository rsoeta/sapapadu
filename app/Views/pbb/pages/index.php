<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<!-- <script src="<?= base_url('assets/plugins/chart.js/chartjs-plugin-labels.min.js'); ?>"></script> -->
<script src="<?= base_url('assets/plugins/chart.js/3.7.0/chart.min.js'); ?>"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <section class="content">
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
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="thread-desa">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-7">
                                <h4 class="text-center">
                                    <strong>Chart Desa</strong>
                                </h4>
                                <div class="chart-container" style="position: relative; height:50vh; width:100%">
                                    <canvas id="thread-desa-canvas" style="width: 100%;"></canvas>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-5">
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm" style="width: 100%;">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Desa</th>
                                                <th>Target</th>
                                                <th>Capaian</th>
                                                <th>Data Bermasalah</th>
                                                <th>Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- looping setoranPerDesa -->
                                            <?php $i = 1; ?>
                                            <?php foreach ($setoranPerDesa as $setoran) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $setoran->desaNama; ?></td>
                                                    <td style="text-align:right;"><?= number_format($setoran->dataTarget, 0, ',', '.'); ?></td>
                                                    <td style="text-align:right;"><?= number_format($setoran->dataCapaian, 0, ',', '.'); ?></td>
                                                    <td style="text-align:right;"><?= number_format($setoran->dataBermasalah, 0, ',', '.'); ?></td>
                                                    <td style="text-align:right;"><?= number_format($setoran->dataPersentase, 2, ',', '.') . ' %'; ?></td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            </tr>
                                        </tfoot>
                                    </table>
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
            <?php foreach ($setoranPerDesa  as $row) : ?> '<?= $row->desaNama; ?>', <?php endforeach ?>
        ],
        datasets: [{
                label: 'Target',
                data: [
                    <?php
                    foreach ($setoranPerDesa  as $row) : ?>
                        <?php echo '"' . $row->dataTarget . '",'; ?>
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
                        <?php echo '"' . $row->dataCapaian . '",'; ?>
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
        type: 'bar',
        data: data_desa,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
            // responsive: true,
            // tooltips: {
            //     callbacks: {
            //         label: function(tooltipItem, data_desa) {
            //             return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            //         }
            //     }
            // },
        }
    };

    // render init block
    const chartDesa = new Chart(
        document.getElementById('thread-desa-canvas'),
        config_desa
    );
</script>
<?= $this->endSection(); ?>