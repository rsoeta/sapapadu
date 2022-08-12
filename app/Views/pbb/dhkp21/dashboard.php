<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->

        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note : </h5>
            Selamat datang <?= session()->get('fullname'); ?>, Selamat Bekerja!
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Charts
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="column">
                    <h2 class="title-statistik">Total DHKP</h2>
                    <div class="hero-text"><?= $jml_dhkp; ?></div>
                </div>
                <div class="column">
                    <h2 class="title-statistik">Total Dusun</h2>
                    <div class="hero-text"><?= $jml_dusun; ?></div>
                </div>
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                        <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div><!-- /.card-body -->
            <div class="row p-5">
                <div class="column">
                    <div class="container-white">
                        <h4>DHKP per Dusun</h4>
                        <canvas id="dhkp_dusun" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('assets\plugins\chart.js\Chart.bundle.min.js'); ?>"></script>
<script>
    var dhkp_dusun = document.getElementById('dhkp_dusun');
    var data_dhkp_dusun = [];
    var label_dhkp_dusun = [];
    <?php foreach ($dhkpPerDusun->getResult() as $key => $value) : ?>
        data_dhkp_dusun.push(<?= $value->jumlah ?>);
        label_dhkp_dusun.push('<?= $value->dusun ?>');
    <?php endforeach; ?>

    var data_dhkp_per_dusun = {
        datasets: [{
            data: data_dhkp_dusun,
            backgroundColor: [
                'rgba(255,99,132,0.8)',
                'rgba(54,162,235,0.8)',
                'rgba(255,206,86,0.8)',
            ],
        }],
        labels: label_dhkp_dusun,
    }
    var chart_dhkp_dusun = new Chart(dhkp_dusun, {
        type: 'doughnut',
        data: data_dhkp_per_dusun
    });
</script>
<?= $this->endSection(); ?>