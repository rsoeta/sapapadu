<!doctype html>
<html lang="id">

<head>

	<meta charset="utf-8">
	<title><?= namaApp(); ?></title>

	<link rel="apple-touch-icon" href="<?= base_url('pbb_ico/apple-touch-icon.png'); ?>">
	<link rel="apple-touch-icon" sizes="16x16" href="<?= base_url('pbb_ico/favicon-16x16.png'); ?>">
	<link rel="apple-touch-icon" sizes="32x32" href="<?= base_url('pbb_ico/favicon-32x32.png'); ?>">
	<link rel="apple-touch-icon" sizes="150x150" href="<?= base_url('pbb_ico/mstile-150x150.png'); ?>">
	<link rel="apple-touch-icon" sizes="192x192" href="<?= base_url('pbb_ico/android-chrome-192x192.png'); ?>">
	<link rel="apple-touch-icon" sizes="384x384" href="<?= base_url('pbb_ico/android-chrome-384x384.png'); ?>">
	<link rel="icon" type="ico" sizes="192x192" href="<?= base_url('favicon.ico'); ?>">
	<link rel="icon" type="ico" sizes="32x32" href="<?= base_url('favicon.ico'); ?>">
	<link rel="icon" type="ico" sizes="96x96" href="<?= base_url('favicon.ico'); ?>">
	<link rel="icon" type="ico" sizes="16x16" href="<?= base_url('favicon.ico'); ?>">
	<link rel="manifest" href="<?= base_url('pbb_ico/manifest.json'); ?>">

	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="author" content="Rian Sutarsa">
	<meta name="keywords" content="<?= deskApp(); ?>">
	<meta name="description" content="<?= deskApp(); ?>">

	<meta property="og:title" content="<?= namaApp(); ?>" />
	<meta property="og:description" content="<?= deskApp(); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= base_url(); ?>" />
	<meta property="og:image" content="<?= base_url('pbb_ico/android-chrome-192x192.png'); ?>" />

	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@sutarsarian" />
	<meta name="twitter:creator" content="@sutarsarian" />
	<meta name="twitter:title" content="<?= namaApp(); ?>" />
	<meta name="twitter:description" content="<?= deskApp(); ?>" />
	<meta name="twitter:image" content="<?= base_url('pbb_ico/android-chrome-192x192.png'); ?>" />

	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- bootstrap css -->
	<link rel="stylesheet" href=<?= base_url('assets/diigo/css/bootstrap.min.css'); ?>>
	<!-- style css -->
	<link rel="stylesheet" href=<?= base_url('assets/diigo/css/style.css'); ?>>
	<!-- Responsive-->
	<link rel="stylesheet" href=<?= base_url('assets/diigo/css/responsive.css'); ?>>
	<!-- fevicon -->
	<link rel="icon" type="image/gif" href=<?= base_url('favicon.ico'); ?>>
	<!-- Scrollbar Custom CSS -->
	<link rel="stylesheet" href=<?= base_url('assets/diigo/css/jquery.mCustomScrollbar.min.css'); ?>>
	<!-- Tweaks for older IEs-->
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout">
	<!-- loader  -->

	<div class="loader_bg">
		<div class="loader"><img src="<?= base_url('assets/diigo/images/loading.gif'); ?>" alt="#" /></div>
	</div>
	<!-- end loader -->
	<!-- header -->
	<header>
		<!-- header inner -->
		<div class="head_top">
			<div class="header">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
							<div class="full">
								<div class="center-desk">
									<div class="logo">
										<a href="<?= base_url(); ?>"><img src="<?= base_url('img/Free_Sample_By_Wix.png'); ?>" alt="logo <?= namaApp(); ?>" /></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
							<nav class="navigation navbar navbar-expand-md navbar-dark">
								<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<div class="collapse navbar-collapse" id="navbarsExample04">
									<ul class="navbar-nav mr-auto">
										<li class="nav-item">
											<a class="nav-link" href="<?= base_url(); ?>"> Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#business"> About</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#contact"> Contact</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="/login"> Sign In</a>
										</li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
			<!-- end header inner -->
			<!-- end header -->
			<!-- banner -->
			<section class="banner_main">
				<div class="container-fluid">
					<div class="row d_flex">
						<div class="col-md-6">
							<div class="text-bg">
								<h1>Pajak Bumi dan Bangunan</h1>
								<p>Pajak Bumi dan Bangunan (PBB) merupakan salah satu jenis pajak daerah yang dikenakan atas tanah dan bangunan. Adanya PBB karena kepemilikan hak, penguasaan, dan/atau perolehan manfaat terhadap suatu tanah/bumi dan bangunan. Lalu bagaimana dengan PBB P2?</p>
								<a href="#pajak">Read More</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-img">
								<figure><img src="<?= base_url('assets/diigo/images/box_img.png'); ?>" alt="#" /></figure>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</header>
	<!-- end banner -->
	<!-- business -->
	<div class="business" id="business">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titlepage">
						<h3>Diagram Target dan Capaian</h3>
					</div>
					<div class="card">
						<div class="card-header">
						</div>
						<div class="card-body"></div>
						<div class="card-footer"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end business -->
	<!-- Projects -->
	<div class="projects">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titlepage">
						<h3>Cek Pembayaran</h3>
						<div class="card">
							<div class="card-header">
							</div>
							<div class="card-body"></div>
							<div class="card-footer"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end projects -->
	<!-- Testimonial -->
	<div class="section">
		<div class="container">
			<div id="pajak" class="Testimonial">
				<div class="row">
					<div class="col-md-12">
						<div class="titlepage">
							<h2>Testimonial</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="Testimonial_box">
							<i><img src="<?= base_url('assets/diigo/images/logo-garutkab.png'); ?>" alt="#" /></i>
						</div>
					</div>
					<div class="col-md-9">
						<div class="Testimonial_box">
							<h4>Pajak Bumi dan Bangunan</h4>
							<p>Pajak Bumi dan Bangunan (PBB) merupakan salah satu jenis pajak daerah yang dikenakan atas tanah dan bangunan. Adanya PBB karena kepemilikan hak, penguasaan, dan/atau perolehan manfaat terhadap suatu tanah/bumi dan bangunan. Lalu bagaimana dengan PBB P2? <br>

								Sedangkan PBB P2, merujuk pada Pasal 1 angka 37 UU PDRD (Pajak Daerah dan Retribusi Daerah) adalah pajak atas bumi dan/atau bangunan yang dimiliki, dikuasai, dan/atau dimanfaatkan oleh orang pribadi atau badan, kecuali kawasan yang digunakan untuk kegiatan usaha perkebunan, perhutanan, dan pertambangan.

								Objek PBB P2
								Untuk objeknya sendiri, sesuai dengan nama untuk tiap sektornya. Objek pajak PBB P2 adalah bumi dan bangunan yang ada di wilayah perkotaan dan perdesaan. Misalnya rumah, hotel, apartemen, rumah susun, pabrik, tanah kosong, dan sawah. Merujuk pada pasal 80 ayat (1) UU PDRD, tarif maksimal yang telah ditetapkan untuk PBB P2 adalah sebesar 0,3%. Namun, tarif ini bervariasi, tergantung dari kebijakan pemerintah daerah yang bersangkutan.

								Sedangkan untuk Nilai Jual Objek Pajak Tidak Kena Pajak (NJOPTKP) yang merupakan batas nilai yang tidak dikenakan pajak PBB P2 ditetapkan paling rendah sebesar Rp10 juta untuk setiap wajib pajak.

								Selain jenis PBB di atas, dikenal juga istilah PBB P3 yang dikelola oleh pemerintah pusat. Objek pajak dari PBB P3 adalah perkebunan, perhutanan, pertambangan, dan sektor lainnya yang meliputi perikanan tangkap, budidaya ikan, jaringan pipa, kabel telekomunikasi, kabel listrik, dan jalan tol.

								Berikut ini objek pajak yang tidak dikenakan PBB P2:

								Digunakan oleh pemerintah pusat dan daerah untuk penyelenggaraan pemerintahan.
								Semata-mata untuk melayani kepentingan umum di bidang ibadah, sosial, kesehatan, pendidikan, dan kebudayaan nasional. Tentu tidak dimaksudkan untuk memperoleh keuntungan.
								Digunakan untuk pemakaman, peninggalan purbakala, atau sejenisnya.
								Hutan lindung, hutan suaka alam, hutan wisata, taman nasional, tanah penggembalaan yang dikuasai oleh desa, dan tanah negara yang belum dibebani suatu hak.
								Digunakan oleh perwakilan diplomatik dan konsulat berdasarkan asas perlakuan timbal balik.
								Digunakan oleh badan atau perwakilan lembaga internasional yang ditetapkan dengan Peraturan Menteri Keuangan (PMK).
								Nilai Jual Kena Pajak (NJKP) PBB
								Dalam hal perhitungannya, tidak ada unsur Nilai Jual Kena Pajak (NJKP) yang merupakan persentase tertentu dari nilai jual objek pajak (NJOP). Berbeda dengan perhitungan dasar PBB P3 yang mengenal adanya NJKP.

								Berdasarkan Pasal 6 ayat (3) UU PBB, NJKP ditentukan paling rendah 20% dan paling tinggi 100% dari NJOP. Nah, untuk PBB P3 itu sendiri, yang masuk pada sektor perkebunan, kehutanan, dan pertambangan sebesar 40% dari NJOP. Lain jika objek pajak sektor lainnya, NJKP ditetapkan sebesar 40% apabila NJOP mencapai Rp1 miliar atau lebih. Bila objek pajak lainnya memiliki NJOP &lt;Rp1 miliar, maka NJKP yang ditetapkan sebesar 20%.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end Testimonial -->
	<!-- contact -->
	<div id="contact" class="contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="titlepage">
						<h2>Contact us</h2>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 ">
					<form class="main_form ">
						<div class="row">
							<div class="col-md-12 ">
								<input class="form_contril" placeholder="Name " type="text" name="Name ">
							</div>
							<div class="col-md-12">
								<input class="form_contril" placeholder="Phone Number" type="text" name=" Phone Number">
							</div>
							<div class="col-md-12">
								<input class="form_contril" placeholder="Email" type="text" name="Email">
							</div>
							<div class="col-md-12">
								<textarea class="textarea" placeholder="Message" type="text" name="Message"></textarea>
							</div>
							<div class="col-sm-12">
								<button class="send_btn">Send</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact -->
	<!--  footer -->
	<footer>
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ">
						<div class="cont">
							<h3>
								<?= namaApp() . ' Kec. ' . ucwords(strtolower(profilAdmin()->name)) . ' ' . date('Y'); ?>
							</h3>
						</div>
					</div>
					<div class="col-md-12">
						<ul class="social_icon">
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>Copyright &copy; 2022 All Right Reserved By Kasi Pemerintahan Kec. <?= ucwords(strtolower(profilAdmin()->name)); ?>. design by: <a href="https://html.design/"> Free html Templates</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->
	<!-- Javascript files-->
	<script src="<?= base_url('assets/diigo/js/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/diigo/js/popper.min.js'); ?>"></script>
	<script src="<?= base_url('assets/diigo/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?= base_url('assets/diigo/js/jquery-3.0.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/diigo/js/plugin.js'); ?>"></script>
	<!-- sidebar -->
	<script src="<?= base_url('assets/diigo/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
	<script src="<?= base_url('assets/diigo/js/custom.js'); ?>"></script>
	<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>