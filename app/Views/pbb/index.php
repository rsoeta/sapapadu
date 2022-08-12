<!DOCTYPE html>
<html lang="id" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Rian Sutarsa">
    <meta name="keywords" content="<?= deskApp(); ?>">
    <meta name="description" content="<?= deskApp(); ?>">

    <meta http-equiv="refresh" content="3600">

    <!-- Facebook Open Graph -->
    <meta property="og:title" content="<?= $namaApp; ?> | <?= $title; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url(); ?>" />
    <meta property="og:image" content="<?= base_url('pages/home/images/a.jpg') ?>" />
    <meta property="og:description" content="<?= deskApp(); ?>">
    <meta property="og:site_name" content="<?= $namaApp; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@kolektorpbb" />
    <meta name="twitter:creator" content="@kolektorpbb" />
    <meta name="twitter:title" content="<?= $namaApp; ?> | <?= $title; ?>" />
    <meta name="twitter:description" content="<?= deskApp(); ?>" />
    <meta name="twitter:image" content="<?= base_url('pages/home/images/a.jpg') ?>" />

    <!-- site title -->
    <title><?= $namaApp; ?> | <?= $title; ?></title>

    <!-- CSSku -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/csspbb.css">

    <!-- Stylesheets css comes here -->
    <link rel="stylesheet" href="<?= base_url(); ?>/pages/home/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/pages/home/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/pages/home/css/nivo-lightbox.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/pages/home/css/nivo_themes/default/default.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/pbb-home-style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');
    </style>
    <!-- Bootstrap Css -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->


    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">

    <!-- sweetalert -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/bootstrap-5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">

    <script src="<?= base_url(); ?>/assets/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Memasang jQuery Migrate -->
    <script src="<?= base_url('assets/jquery/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?= base_url(); ?>/assets/plugins/chart.js/3.7.0/chart.min.js"></script>

    <script src="<?= base_url(); ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- javascript js comes here -->
    <script src="<?= base_url(); ?>/pages/home/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/smoothscroll.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/jquery.nav.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/isotope.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/imagesloaded.min.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/nivo-lightbox.min.js"></script>
    <script src="<?= base_url(); ?>/pages/home/js/wow.min.js"></script>

    <!-- Js Bootstrap -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->


</head>

<body>
    <!-- navigation section -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('pbb'); ?>"><strong><?= $namaApp; ?></strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cekBayar">Cek Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutUs">About Us</a>
                    </li>
                </ul>
                <hr class="">
                <span class="navbar-text">
                    <a href="/pbb/auth/login" class="nav-link">
                        <i class="fa fa-sign-in-alt fa-lg"></i>
                    </a>
                </span>
            </div>
        </div>
    </nav>

    <!-- home section -->
    <div class="container">

        <section id="home" class="tm-home">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">

                    </div>
                </div>
            </div>
        </section>
        <!-- social icons section -->
        <section class="mt-6">
            <div class="container">
                <div class="row">
                    <img src="<?= base_url('pages/home/images/a.jpg'); ?>" alt="Membayar Pajak Tanda Cinta Tanah Air">
                </div>
            </div>
        </section>

        <section class="mt-3">
            <div class="card card-info">
                <div class="card-header">
                    <h5 class="card-title text-center">CAPAIAN PBB-P2 TAHUN 2022</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card-body">
                            <canvas id="chartDusun" height="10%" style="height: 50px; display: block; width: 100px;" width="10%" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="card-footer">
                            <?php foreach ($setoranPerDusun  as $row) : ?>
                                <?php if ($row['pajak0'] > 0 || $row['pajak1'] > 0) : ?>
                                    <div class="progress-group">
                                        Persentase Dusun : <?php echo $row['dusun']; ?>
                                        <span class="float-right"><b><?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . '%' ?></b></span>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . "%" ?>"></div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body">
                            <canvas id="chartRw" height="10%" style="height: 50px; display: block; width: 100px;" width="10%" class="chartjs-render-monitor"></canvas>
                        </div>
                        <div class="card-footer">
                            <?php foreach ($setoranPerRw  as $row) : ?>
                                <?php if ($row['pajak0'] > 0 || $row['pajak1'] > 0) : ?>

                                    <div class="progress-group">
                                        Persentase RW <?php echo $row['rw'];
                                                        ?> :
                                        <span class="float-right"><b><?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . '%';
                                                                        ?></b></span>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped bg-success  progress-bar-animated" style="width: <?php echo round(($row['pajak0'] / $row['pajak1']) * 100, 2) . "%"; ?>"></div>
                                        </div>
                                    </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title text-center">CEK STATUS PBB ANDA</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" id="cekBayar">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-sm-4">
                                <img src="<?= base_url('assets/home/images/ilustrasi-pbb_169.jpeg'); ?>" class="img-fluid rounded-start" alt="Cek Status PBB Anda">
                            </div>
                            <div class="col-1">
                            </div>
                            <div class="col-sm-7">
                                <div class="form-group row mt-2">
                                    <label for="nop" class="col-3 col-form-label">N.O.P</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="nop" name="nop" placeholder="Masukan No. Objek Pajak">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="nama_wp" class="col-3 col-form-label">Nama WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="nama_wp" name="nama_wp" placeholder="Masukan Nama Wajib Pajak">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label class="col-3 col-form-label"></label>
                                    <div class="col-9 d-grid gap-2">
                                        <button type="button" class="btn btn-primary" id="btnCek">Cek</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </section>

        <section id="aboutUs" class="mt-3">
            <div class="card mb-3">
                <img src="<?= base_url('assets/images/about-img2.jpg'); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Sekilas tentang PBB P2</h5>
                    <p>Pajak Bumi dan Bangunan (PBB) merupakan salah satu jenis pajak daerah yang dikenakan atas tanah dan bangunan. Adanya PBB karena kepemilikan hak, penguasaan, dan/atau perolehan manfaat terhadap suatu tanah/bumi dan bangunan. Lalu bagaimana dengan PBB P2?</p>
                    <P>Sedangkan PBB P2, merujuk pada Pasal 1 angka 37 UU PDRD (Pajak Daerah dan Retribusi Daerah) adalah pajak atas bumi dan/atau bangunan yang dimiliki, dikuasai, dan/atau dimanfaatkan oleh orang pribadi atau badan, kecuali kawasan yang digunakan untuk kegiatan usaha perkebunan, perhutanan, dan pertambangan.</p>

                    <h5 class="card-title">Objek PBB P2</h5>
                    <p>Untuk objeknya sendiri, sesuai dengan nama untuk tiap sektornya. Objek pajak PBB P2 adalah bumi dan bangunan yang ada di wilayah perkotaan dan perdesaan. Misalnya rumah, hotel, apartemen, rumah susun, pabrik, tanah kosong, dan sawah. Merujuk pada pasal 80 ayat (1) UU PDRD, tarif maksimal yang telah ditetapkan untuk PBB P2 adalah sebesar 0,3%. Namun, tarif ini bervariasi, tergantung dari kebijakan pemerintah daerah yang bersangkutan.&nbsp;</p>

                    <p>Sedangkan untuk Nilai Jual Objek Pajak Tidak Kena Pajak (NJOPTKP) yang merupakan batas nilai yang tidak dikenakan pajak PBB P2 ditetapkan paling rendah sebesar Rp10 juta untuk setiap wajib pajak.&nbsp;</p>

                    <p>Selain jenis PBB di atas, dikenal juga istilah PBB P3 yang dikelola oleh pemerintah pusat. Objek pajak dari PBB P3 adalah perkebunan, perhutanan, pertambangan, dan sektor lainnya yang meliputi perikanan tangkap, budidaya ikan, jaringan pipa, kabel telekomunikasi, kabel listrik, dan jalan tol.&nbsp;</p>

                    <p>Berikut ini objek pajak yang tidak dikenakan PBB P2:&nbsp;</p>
                    <ul>
                        <li>Digunakan oleh pemerintah pusat dan daerah untuk penyelenggaraan pemerintahan.&nbsp;</li>
                        <li>Semata-mata untuk melayani kepentingan umum di bidang ibadah, sosial, kesehatan, pendidikan, dan kebudayaan nasional. Tentu tidak dimaksudkan untuk memperoleh keuntungan.&nbsp;</li>
                        <li>Digunakan untuk pemakaman, peninggalan purbakala, atau sejenisnya.</li>
                        <li>Hutan lindung, hutan suaka alam, hutan wisata, taman nasional, tanah penggembalaan yang dikuasai oleh desa, dan tanah negara yang belum dibebani suatu hak.&nbsp;</li>
                        <li>Digunakan oleh perwakilan diplomatik dan konsulat berdasarkan asas perlakuan timbal balik.&nbsp;</li>
                        <li>Digunakan oleh badan atau perwakilan lembaga internasional yang ditetapkan dengan Peraturan Menteri Keuangan (PMK).&nbsp;</li>
                    </ul>

                    <h5>Nilai Jual Kena Pajak (NJKP) PBB</h5>

                    <p>Dalam hal perhitungannya, tidak ada unsur Nilai Jual Kena Pajak (NJKP) yang merupakan persentase tertentu dari nilai jual objek pajak (NJOP). Berbeda dengan perhitungan dasar PBB P3 yang mengenal adanya NJKP.</p>

                    <p>Berdasarkan Pasal 6 ayat (3) UU PBB, NJKP ditentukan paling rendah 20% dan paling tinggi 100% dari NJOP. Nah, untuk PBB P3 itu sendiri, yang masuk pada sektor perkebunan, kehutanan, dan pertambangan sebesar 40% dari NJOP. Lain jika objek pajak sektor lainnya, NJKP ditetapkan sebesar 40% apabila NJOP mencapai Rp1 miliar atau lebih. Bila objek pajak lainnya memiliki NJOP &lt;Rp1 miliar, maka NJKP yang ditetapkan sebesar 20%.&nbsp;</p>

                    <p><strong>Rumusnya:&nbsp;</strong></p>

                    <p><strong>&#8211; Perhitungan PBB P2:&nbsp;</strong></p>

                    <p>Tarif x Dasar pengenaan pajak (NJOP Bumi + NJOP Bangunan &#8211; NJOPTKP)&nbsp;</p>

                    <p><strong>&#8211; Perhitungan PBB P3:&nbsp;</strong></p>

                    <p>Tarif x NJKP x (NJOP &#8211; NJOPTKP)</p>

                    <p>0,5% x 20% x (NJOP &#8211; NJOPTKP) atau 0,5% x 40% x (NJOP &#8211; NJOPTKP)</p>

                    <h5>Kesimpulan</h5>

                    <ol>
                        <li>Termasuk jenis pajak daerah.&nbsp;</li>
                        <li>Memiliki sifat yang lokal, visibilitas, objek pajak tidak berpinda (immobile), dan terdapat hubungan erat antara pembayar pajak dan yang menikmati hasil pajaknya.&nbsp;</li>
                        <li>Pengalihan PBB P2 ini diharapkan dapat meningkatkan pendapatan daerah. </li>
                    </ol>
                    <footer class="blockquote-footer mt-auto">Source: <a href="https://www.online-pajak.com/tentang-pajak/mengenal-pbb-p2">www.online-pajak.com</a></footer>
                </div>
            </div>
        </section>

        <footer>
            <div class="row">
                <div class="col-12">
                    <!-- <img src="<?= base_url(); ?>/assets/home/images/logo.png" class="img-responsive" alt="footer logo"> -->
                    <p>Copyright &copy; 2021 <a href="<?= base_url(); ?>" style="text-decoration: none;">kolaborasi</a>
                        | Design: <a rel="nofollow" href="https://templatemo.com" title="free templates">Template Mo</a>
                    </p>
                    <hr>
                    <div class="col-12">
                        <a href="https://web.facebook.com/sutarsarian" target="blank"><img src="https://img.icons8.com/ios/50/000000/facebook-f.png" width="25" height="25"></a> --
                        <a href="https://twitter.com/riansutarsa" target="blank"><img src="https://img.icons8.com/carbon-copy/100/000000/twitter--v2.png" width="30" height="30"></a> --
                        <a href="https://www.instagram.com/sutarsarian/" target="blank"><img src="https://img.icons8.com/carbon-copy/50/000000/instagram-new.png" width="30" height="30"></a>
                    </div>
                    <br>
                </div>
            </div>
        </footer>
    </div>

    <div class="viewmodal" style="display: none;"></div>
    <script src="<?= base_url() ?>/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/assets/dist/js/demo.js"></script>

    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script>
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
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
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
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
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
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Chart Per-Dusun'
                    }
                }
            }
        };

        // render init block
        const chartDusun = new Chart(
            document.getElementById('chartDusun'),
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
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 99, 132, 1)',
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
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(54, 162, 235, 1)',
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
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Chart Per-RW'
                    }
                }
            }
        };
        // render init block
        const myChart = new Chart(
            document.getElementById('chartRw'),
            config_rw
        );

        $(document).ready(function() {

            $('#btnCek').click(function(e) {
                e.preventDefault();
                // alert('OK!');
                cek();
            });

        });

        function cek() {
            let nop = $('#nop').val();
            let nama_wp = $('#nama_wp').val();

            $.ajax({
                type: "post",
                url: "<?= site_url('pbb/auth/cari'); ?>",
                data: {
                    nop: nop,
                    nop: $('#nop').val(),
                    nama_wp: $('#nama_wp').val(),
                },
                cache: false,
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Perhatian!',
                            text: response.error
                        });
                    }
                    if (response.null) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian!',
                            text: response.null
                        });
                    }
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#hasil_pencarian').on('shown.bs.modal', function(event) {
                            $('#nop').focus();
                        });
                        $('#hasil_pencarian').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    </script>
</body>

</html>