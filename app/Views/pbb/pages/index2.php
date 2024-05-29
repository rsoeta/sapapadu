<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    .info-box {
        height: 100px;
        /* Created with https://www.css-gradient.com */
        /* background: #125CD1;
        background: -webkit-linear-gradient(right, #125CD1, #556EDB);
        background: -moz-linear-gradient(right, #125CD1, #556EDB);
        background: linear-gradient(to left, #125CD1, #556EDB); */
        /* Created with https://www.css-gradient.com */
        background: #12A3FE;
        background: -webkit-linear-gradient(left, #12A3FE, #019BC9);
        background: -moz-linear-gradient(left, #12A3FE, #019BC9);
        background: linear-gradient(to right, #12A3FE, #019BC9);
    }

    .text-info-box {
        overflow: hidden;
        display: inline-block;
        text-overflow: ellipsis;
    }

    .info-box-icon {
        background-color: aliceblue;
        /* Created with https://www.css-gradient.com */
    }

    .fa-lg {
        color: black;
    }

    .info-box-number {
        color: whitesmoke;
    }

    .biru {
        color: #0040ff;
    }

    .kuning {
        color: #b3b300;
    }

    .lime {
        color: #00ff00;
    }

    .merah-tua {
        color: #cc0000;
    }
</style>

<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="min-height: 608px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard v2</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v2</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="dhkp22">
                            <div class="info-box mb-3">
                                <span class="info-box-icon elevation-1"><i class="fas fa-copy fa-lg"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">DHKP</span>
                                    <p>Daftar Himpunan Ketetapan Pajak</p>
                                </div>
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <!-- <div class="clearfix hidden-md-up"></div> -->

                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="trx22-pembayaran">
                            <div class="info-box mb-3">
                                <span class="info-box-icon elevation-1"><i class="fas fa-wallet fa-lg biru"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-number">Pembayaran</span>
                                    <p>Buat Invoice Pembayaran SPPT</p>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <a href="diagram">
                            <div class="info-box">
                                <span class="info-box-icon elevation-1"><i class="fa fa-chart-pie fa-lg lime"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-number">Grafik</span>
                                    <div class="text-info-box">
                                        <p>Grafik Progres Pajak Bumi dan Bangunan</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- /.info-box -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>

<?= $this->endSection(); ?>