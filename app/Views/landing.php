<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= namaApp(); ?></title>

	<!-- Meta Tags & SEO -->
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="author" content="Rian Sutarsa">
	<meta name="keywords" content="<?= deskApp(); ?>">
	<meta name="description" content="<?= deskApp(); ?>">

	<!-- Open Graph / Social Media -->
	<meta property="og:title" content="<?= namaApp(); ?>" />
	<meta property="og:description" content="<?= deskApp(); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= base_url(); ?>" />
	<meta property="og:image" content="<?= base_url('pbb_ico/android-chrome-192x192.png'); ?>" />

	<!-- Icons -->
	<link rel="apple-touch-icon" sizes="192x192" href="<?= base_url('pbb_ico/android-chrome-192x192.png'); ?>">
	<link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico'); ?>">

	<!-- Fonts: Quicksand (Sesuai Permintaan) -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

	<!-- Tailwind CSS (CDN for easy drop-in replacement) -->
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					fontFamily: {
						sans: ['Quicksand', 'sans-serif']
					},
					colors: {
						// Tema warna disesuaikan dengan gambar (Ocean Blue/Cyan & Purple)
						brand: {
							50: '#f0f9ff',
							100: '#e0f2fe',
							200: '#bae6fd',
							300: '#7dd3fc',
							400: '#38bdf8',
							500: '#0ea5e9',
							600: '#0284c7',
							700: '#0369a1',
							800: '#075985',
							900: '#0c4a6e'
						},
						accent: {
							50: '#faf5ff',
							100: '#f3e8ff',
							500: '#a855f7',
							600: '#9333ea',
							700: '#7e22ce',
							800: '#6b21a8',
							900: '#581c87'
						}
					}
				}
			}
		}
	</script>

	<!-- FontAwesome & SweetAlert & ChartJS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		/* Custom scrollbar for ranking lists */
		.custom-scroll::-webkit-scrollbar {
			width: 6px;
		}

		.custom-scroll::-webkit-scrollbar-track {
			background: #f1f5f9;
			border-radius: 4px;
		}

		.custom-scroll::-webkit-scrollbar-thumb {
			background: #cbd5e1;
			border-radius: 4px;
		}

		.custom-scroll::-webkit-scrollbar-thumb:hover {
			background: #94a3b8;
		}

		.glass-nav {
			background: rgba(255, 255, 255, 0.95);
			backdrop-filter: blur(10px);
		}

		/* Custom shape to mimic the fluid background from image */
		.bg-fluid {
			background-color: #f0f9ff;
			background-image:
				radial-gradient(at 0% 0%, hsla(199, 92%, 85%, 1) 0px, transparent 50%),
				radial-gradient(at 100% 0%, hsla(280, 80%, 90%, 1) 0px, transparent 50%),
				radial-gradient(at 100% 100%, hsla(199, 85%, 75%, 0.8) 0px, transparent 50%),
				radial-gradient(at 0% 100%, hsla(280, 85%, 85%, 0.7) 0px, transparent 50%);
		}
	</style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-accent-500 selection:text-white">

	<!-- Loader -->
	<div id="loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
		<div class="flex flex-col items-center gap-4">
			<div class="w-12 h-12 border-4 border-brand-200 border-t-accent-600 rounded-full animate-spin"></div>
			<p class="text-accent-600 font-bold tracking-wide">Memuat Data...</p>
		</div>
	</div>

	<!-- Navigation -->
	<nav class="fixed w-full z-50 glass-nav border-b border-brand-100 transition-all duration-300 shadow-sm">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex justify-between items-center h-20">
				<!-- Logo -->
				<div class="flex-shrink-0 flex items-center gap-3">
					<img class="h-10 w-auto object-contain" src="<?= base_url('img/Free_Sample_By_Wix.png'); ?>" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3061/3061341.png'" alt="Logo <?= namaApp(); ?>">
					<span class="font-bold text-xl text-brand-900 hidden sm:block"><?= namaApp(); ?></span>
				</div>

				<!-- Desktop Menu -->
				<div class="hidden md:flex items-center space-x-8">
					<a href="<?= base_url(); ?>" class="text-slate-600 hover:text-accent-600 font-bold transition">Beranda</a>
					<a href="#dashboard-section" class="text-slate-600 hover:text-accent-600 font-bold transition">Dashboard</a>
					<a href="#informasi" class="text-slate-600 hover:text-accent-600 font-bold transition">Informasi</a>
					<a href="#kontak" class="text-slate-600 hover:text-accent-600 font-bold transition">Kontak</a>
					<a href="/login" class="bg-accent-600 hover:bg-accent-700 text-white px-6 py-2.5 rounded-full font-bold shadow-md shadow-accent-500/30 transition-all flex items-center gap-2">
						<i class="fa-solid fa-right-to-bracket"></i> Sign In
					</a>
				</div>

				<!-- Mobile Menu Button -->
				<div class="md:hidden flex items-center">
					<button id="mobile-menu-btn" class="text-brand-600 hover:text-brand-800 focus:outline-none p-2">
						<i class="fa-solid fa-bars text-2xl"></i>
					</button>
				</div>
			</div>
		</div>

		<!-- Mobile Menu Panel -->
		<div id="mobile-menu" class="hidden md:hidden bg-white border-b border-brand-100 absolute w-full">
			<div class="px-4 pt-2 pb-6 space-y-2 shadow-lg">
				<a href="<?= base_url(); ?>" class="block px-4 py-3 rounded-md text-base font-bold text-slate-700 hover:bg-brand-50 hover:text-accent-600">Beranda</a>
				<a href="#dashboard-section" class="block px-4 py-3 rounded-md text-base font-bold text-slate-700 hover:bg-brand-50 hover:text-accent-600">Dashboard</a>
				<a href="#informasi" class="block px-4 py-3 rounded-md text-base font-bold text-slate-700 hover:bg-brand-50 hover:text-accent-600">Informasi</a>
				<a href="#kontak" class="block px-4 py-3 rounded-md text-base font-bold text-slate-700 hover:bg-brand-50 hover:text-accent-600">Kontak</a>
				<a href="/login" class="block mt-4 text-center bg-accent-600 text-white px-4 py-3 rounded-full text-base font-bold hover:bg-accent-700 shadow-md">Sign In</a>
			</div>
		</div>
	</nav>

	<!-- Hero Section -->
	<section class="relative pt-32 pb-20 lg:pt-44 lg:pb-32 overflow-hidden bg-fluid">
		<!-- Abstract Shapes matching image -->
		<div class="absolute top-0 left-0 w-64 h-64 bg-brand-300 rounded-full mix-blend-multiply filter blur-3xl opacity-50 z-0 transform -translate-x-1/2 -translate-y-1/2"></div>
		<div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-200 rounded-full mix-blend-multiply filter blur-3xl opacity-60 z-0 transform translate-x-1/3 translate-y-1/3"></div>

		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
				<div class="text-center lg:text-left">
					<div class="inline-block px-4 py-1.5 mb-6 rounded-full bg-white/70 backdrop-blur-sm text-accent-700 font-bold text-sm border border-brand-200 shadow-sm">
						Layanan Transparansi PBB
					</div>
					<h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-brand-900 leading-tight mb-6">
						Pantau Capaian <br class="hidden lg:block" />
						<span class="text-transparent bg-clip-text bg-gradient-to-r from-accent-600 to-brand-500">Pajak Bumi & Bangunan</span>
					</h1>
					<p class="text-lg text-slate-700 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
						Pajak Bumi dan Bangunan (PBB) merupakan salah satu jenis pajak daerah yang dikenakan atas tanah dan bangunan. Mari wujudkan pembangunan daerah dengan taat membayar pajak tepat waktu.
					</p>
					<div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
						<a href="#dashboard-section" class="bg-accent-600 hover:bg-accent-700 text-white px-8 py-3.5 rounded-full font-bold shadow-lg shadow-accent-500/30 transition-all flex items-center justify-center gap-2">
							<i class="fa-solid fa-chart-pie"></i> Lihat Dashboard
						</a>
						<a href="#informasi" class="bg-white/80 backdrop-blur-md hover:bg-white text-brand-800 border border-brand-200 px-8 py-3.5 rounded-full font-bold shadow-sm transition-all flex items-center justify-center gap-2">
							Pelajari Selengkapnya
						</a>
					</div>
				</div>
				<div class="relative hidden md:block">
					<!-- Placeholder visualisasi hero -->
					<div class="relative rounded-2xl shadow-2xl overflow-hidden border-4 border-white/50 backdrop-blur-sm">
						<img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Dashboard Illustration" class="w-full object-cover h-[400px]">
						<div class="absolute inset-0 bg-gradient-to-tr from-accent-600/30 to-brand-500/20 z-20"></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- DASHBOARD SECTION -->
	<section id="dashboard-section" class="py-12 bg-white relative">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

			<div class="bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-brand-100 overflow-hidden relative z-20 md:-mt-24">

				<!-- Header Dashboard -->
				<div class="bg-brand-50 border-b border-brand-100 px-4 sm:px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-4">
					<div class="flex items-center gap-3">
						<div class="w-12 h-12 rounded-xl bg-accent-100 text-accent-600 flex items-center justify-center text-xl shadow-sm">
							<i class="fa-solid fa-chart-line"></i>
						</div>
						<div>
							<h2 class="text-xl sm:text-2xl font-black text-brand-900">Dashboard Capaian PBB</h2>
							<p class="text-sm text-slate-500 font-medium">Tahun <span class="font-bold text-accent-600"><?= date('Y'); ?></span></p>
						</div>
					</div>
				</div>

				<div class="p-4 sm:p-6 lg:p-8">
					<!-- FILTER AREA -->
					<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 bg-slate-50 p-4 sm:p-5 rounded-2xl border border-brand-100">
						<div>
							<label class="block text-xs font-bold text-brand-700 uppercase tracking-wider mb-2">Dusun</label>
							<div class="relative">
								<select id="filterDusun" class="w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all shadow-sm font-medium">
									<option value="">Memuat...</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
									<i class="fa-solid fa-chevron-down text-sm"></i>
								</div>
							</div>
						</div>

						<div>
							<label class="block text-xs font-bold text-brand-700 uppercase tracking-wider mb-2">RW</label>
							<div class="relative">
								<select id="filterRw" class="w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all shadow-sm font-medium">
									<option value="">Semua RW</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
									<i class="fa-solid fa-chevron-down text-sm"></i>
								</div>
							</div>
						</div>

						<div>
							<label class="block text-xs font-bold text-brand-700 uppercase tracking-wider mb-2">RT</label>
							<div class="relative">
								<select id="filterRt" class="w-full pl-4 pr-10 py-3 bg-white border border-slate-200 rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-accent-500 focus:border-transparent transition-all shadow-sm font-medium">
									<option value="">Semua RT</option>
								</select>
								<div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
									<i class="fa-solid fa-chevron-down text-sm"></i>
								</div>
							</div>
						</div>
					</div>

					<!-- CHARTS AREA -->
					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 mb-10">
						<!-- Chart Komposisi -->
						<div class="bg-white border border-brand-100 rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-shadow">
							<h3 class="text-center font-bold text-brand-900 mb-6 flex justify-center items-center gap-2">
								<i class="fa-solid fa-pie-chart text-accent-500"></i> Komposisi Pembayaran
							</h3>
							<div class="relative h-[250px] sm:h-[280px] w-full flex justify-center">
								<canvas id="chartKomposisi"></canvas>
							</div>
						</div>

						<!-- Chart Timeline -->
						<div class="bg-white border border-brand-100 rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-md transition-shadow">
							<h3 class="text-center font-bold text-brand-900 mb-6 flex justify-center items-center gap-2">
								<i class="fa-solid fa-chart-area text-accent-500"></i> Timeline Setoran
							</h3>
							<div class="relative h-[250px] sm:h-[280px] w-full">
								<canvas id="chartTimeline"></canvas>
							</div>
						</div>
					</div>

					<!-- RANKING AREA -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<!-- TOP 10 -->
						<div class="bg-white border border-brand-100 rounded-2xl overflow-hidden shadow-sm">
							<div class="bg-gradient-to-r from-brand-500 to-brand-600 text-white px-5 py-4 font-bold flex items-center justify-between">
								<span class="flex items-center gap-2"><i class="fa-solid fa-trophy text-yellow-300"></i> Top 10 RT Tertinggi</span>
							</div>
							<ul id="topList" class="divide-y divide-slate-100 custom-scroll overflow-y-auto max-h-[350px] p-2">
								<li class="p-4 text-center text-slate-400 text-sm font-medium">Memuat data...</li>
							</ul>
						</div>

						<!-- BOTTOM 10 -->
						<div class="bg-white border border-brand-100 rounded-2xl overflow-hidden shadow-sm">
							<div class="bg-gradient-to-r from-accent-500 to-accent-600 text-white px-5 py-4 font-bold flex items-center justify-between">
								<span class="flex items-center gap-2"><i class="fa-solid fa-triangle-exclamation text-yellow-200"></i> Bottom 10 RT Terendah</span>
							</div>
							<ul id="bottomList" class="divide-y divide-slate-100 custom-scroll overflow-y-auto max-h-[350px] p-2">
								<li class="p-4 text-center text-slate-400 text-sm font-medium">Memuat data...</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Informasi PBB -->
	<section id="informasi" class="py-16 md:py-24 bg-brand-50">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
				<h2 class="text-3xl md:text-4xl font-black text-brand-900 mb-4">Informasi PBB & PBB P2</h2>
				<div class="w-24 h-1.5 bg-accent-500 mx-auto rounded-full"></div>
			</div>

			<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
				<!-- Kolom Kiri -->
				<div class="lg:col-span-1 flex flex-col items-center text-center">
					<div class="bg-white p-6 sm:p-8 rounded-3xl border border-brand-100 w-full mb-6 shadow-sm">
						<img src="<?= base_url('assets/diigo/images/logo-garutkab.png'); ?>" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3061/3061341.png'" alt="Logo Pemda" class="w-32 sm:w-40 h-auto mx-auto drop-shadow-md mb-6">
						<h4 class="font-black text-xl text-brand-900">Pajak Bumi dan Bangunan</h4>
						<p class="text-sm text-slate-600 mt-3 font-medium">Membangun daerah bersama melalui ketaatan pajak masyarakat.</p>
					</div>
				</div>

				<!-- Kolom Kanan -->
				<div class="lg:col-span-2 text-slate-700 space-y-6 md:space-y-8 leading-relaxed font-medium">
					<div class="bg-white rounded-2xl p-5 sm:p-6 border-l-4 border-accent-500 shadow-sm">
						<p>Pajak Bumi dan Bangunan (PBB) merupakan salah satu jenis pajak daerah yang dikenakan atas tanah dan bangunan. Adanya PBB karena kepemilikan hak, penguasaan, dan/atau perolehan manfaat terhadap suatu tanah/bumi dan bangunan.</p>
					</div>

					<div>
						<h3 class="text-xl font-bold text-brand-900 border-b-2 border-brand-100 pb-2 mb-3">Apa itu PBB P2?</h3>
						<p>Sedangkan PBB P2, merujuk pada Pasal 1 angka 37 UU PDRD (Pajak Daerah dan Retribusi Daerah) adalah pajak atas bumi dan/atau bangunan yang dimiliki, dikuasai, dan/atau dimanfaatkan oleh orang pribadi atau badan, kecuali kawasan yang digunakan untuk kegiatan usaha perkebunan, perhutanan, dan pertambangan.</p>
					</div>

					<div>
						<h3 class="text-xl font-bold text-brand-900 border-b-2 border-brand-100 pb-2 mb-3">Objek PBB P2</h3>
						<p>Objek pajak PBB P2 adalah bumi dan bangunan yang ada di wilayah perkotaan dan perdesaan. Misalnya rumah, hotel, apartemen, rumah susun, pabrik, tanah kosong, dan sawah. Nilai Jual Objek Pajak Tidak Kena Pajak (NJOPTKP) ditetapkan paling rendah sebesar Rp10 juta untuk setiap wajib pajak.</p>
					</div>

					<div>
						<h3 class="text-xl font-bold text-brand-900 border-b-2 border-brand-100 pb-2 mb-3">Tidak Dikenakan PBB P2:</h3>
						<ul class="list-none space-y-3 mt-3">
							<li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-brand-500 mt-1"></i> <span>Penyelenggaraan pemerintahan pusat dan daerah.</span></li>
							<li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-brand-500 mt-1"></i> <span>Kepentingan umum (ibadah, sosial, kesehatan, pendidikan).</span></li>
							<li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-brand-500 mt-1"></i> <span>Pemakaman dan peninggalan purbakala.</span></li>
							<li class="flex items-start gap-3"><i class="fa-solid fa-circle-check text-brand-500 mt-1"></i> <span>Hutan lindung, suaka alam, taman nasional, dan tanah negara.</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact Section -->
	<section id="kontak" class="py-16 md:py-24 bg-white">
		<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="text-center mb-10 sm:mb-12">
				<h2 class="text-3xl md:text-4xl font-black text-brand-900 mb-4">Hubungi Kami</h2>
				<p class="text-slate-600 font-medium">Ada pertanyaan terkait pelayanan PBB? Silakan kirim pesan kepada kami.</p>
			</div>

			<div class="bg-brand-50 rounded-3xl shadow-sm border border-brand-100 p-6 sm:p-8 md:p-10 relative overflow-hidden">
				<!-- Dekorasi Background Form -->
				<div class="absolute -top-24 -right-24 w-48 h-48 bg-accent-100 rounded-full opacity-50 pointer-events-none"></div>
				<div class="absolute -bottom-24 -left-24 w-48 h-48 bg-brand-200 rounded-full opacity-50 pointer-events-none"></div>

				<form class="space-y-5 sm:space-y-6 relative z-10">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
						<div>
							<label class="block text-sm font-bold text-brand-800 mb-2">Nama Lengkap</label>
							<input type="text" placeholder="Masukkan nama Anda" class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent-500 focus:border-transparent outline-none transition bg-white shadow-sm font-medium">
						</div>
						<div>
							<label class="block text-sm font-bold text-brand-800 mb-2">Nomor Telepon</label>
							<input type="tel" placeholder="Contoh: 08123456789" class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent-500 focus:border-transparent outline-none transition bg-white shadow-sm font-medium">
						</div>
					</div>
					<div>
						<label class="block text-sm font-bold text-brand-800 mb-2">Email</label>
						<input type="email" placeholder="alamat@email.com" class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent-500 focus:border-transparent outline-none transition bg-white shadow-sm font-medium">
					</div>
					<div>
						<label class="block text-sm font-bold text-brand-800 mb-2">Pesan Anda</label>
						<textarea rows="4" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..." class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-accent-500 focus:border-transparent outline-none transition bg-white shadow-sm font-medium"></textarea>
					</div>
					<button type="button" class="w-full bg-accent-600 hover:bg-accent-700 text-white font-bold py-3.5 sm:py-4 rounded-xl shadow-lg shadow-accent-500/30 transition-all flex justify-center items-center gap-2 text-lg mt-2">
						<i class="fa-regular fa-paper-plane"></i> Kirim Pesan
					</button>
				</form>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="bg-brand-900 text-brand-50 pt-16 pb-8">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-12 mb-12 border-b border-brand-800 pb-12">
				<div class="col-span-1 md:col-span-2">
					<h3 class="text-2xl font-black mb-4 flex items-center gap-3 text-white">
						<i class="fa-solid fa-landmark text-accent-400"></i>
						<?= namaApp() . ' ' . (isset(infoApp()->nama_desa) ? infoApp()->nama_desa : 'Desa'); ?>
					</h3>
					<p class="text-brand-200 max-w-md leading-relaxed font-medium">
						Sistem Informasi pencatatan dan pemantauan capaian Pajak Bumi dan Bangunan tingkat desa untuk mewujudkan transparansi dan pembangunan yang lebih baik.
					</p>
				</div>
				<div>
					<h4 class="text-lg font-bold mb-4 text-white">Ikuti Kami</h4>
					<div class="flex gap-3 sm:gap-4">
						<a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center text-brand-300 hover:bg-brand-500 hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
						<a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center text-brand-300 hover:bg-brand-400 hover:text-white transition-all"><i class="fa-brands fa-twitter"></i></a>
						<a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center text-brand-300 hover:bg-accent-500 hover:text-white transition-all"><i class="fa-brands fa-instagram"></i></a>
					</div>
				</div>
			</div>
			<div class="text-center text-brand-400 text-sm font-medium">
				<p>Copyright &copy; 2022 - <?= date('Y'); ?> All Right Reserved. <br class="sm:hidden">
					Pemerintah Desa <?= isset(infoApp()->nama_desa) ? ucwords(strtolower(infoApp()->nama_desa)) : 'Desa'; ?>
					Kec. <?= isset(infoApp()->nama_kecamatan) ? ucwords(strtolower(infoApp()->nama_kecamatan)) : 'Kecamatan'; ?></p>
			</div>
		</div>
	</footer>

	<!-- Scripts Logika -->
	<script>
		// Toggle Mobile Menu
		const btn = document.getElementById('mobile-menu-btn');
		const menu = document.getElementById('mobile-menu');
		btn.addEventListener('click', () => {
			menu.classList.toggle('hidden');
		});

		// Hide Loader
		$(window).on('load', function() {
			$('#loader').css('opacity', '0');
			setTimeout(() => {
				$('#loader').hide();
			}, 500);
		});

		// ---------------------------------------------------------
		// LOGIKA DASHBOARD ASLI DARI LANDING.PHP SEBELUMNYA
		// ---------------------------------------------------------
		const DEFAULT_TAHUN = new Date().getFullYear();

		function pad(n) {
			return String(n).padStart(3, '0');
		}

		let chartKomposisi = null;
		let chartTimeline = null;

		/* INIT */
		document.addEventListener('DOMContentLoaded', () => {
			initCharts();
			loadDusun();
			loadAll();
		});

		/* INIT CHART */
		function initCharts() {
			const el1 = document.getElementById('chartKomposisi');
			const el2 = document.getElementById('chartTimeline');

			if (!el1 || !el2) return;

			// Chart Pie Elegan
			chartKomposisi = new Chart(el1, {
				type: 'pie',
				data: {
					labels: ['Lunas', 'Belum Lunas', 'Bermasalah'],
					datasets: [{
						data: [0, 0, 0],
						// Menyesuaikan warna chart dengan tema Cyan/Blue/Purple
						backgroundColor: ['#0ea5e9', '#a855f7', '#f43f5e'],
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
				}
			});

			// Chart Line Modern
			chartTimeline = new Chart(el2, {
				type: 'line',
				data: {
					labels: [],
					datasets: [{
						label: 'Total Setoran',
						data: [],
						borderColor: '#9333ea', // Warna Accent (Purple)
						backgroundColor: 'rgba(147, 51, 234, 0.1)',
						borderWidth: 3,
						tension: 0.4,
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

		/* LOAD ALL */
		function loadAll() {
			loadKomposisi();
			loadTimeline();
			loadRanking();
		}

		/* DUSUN */
		function loadDusun() {
			$.get('/api/wilayah/dusun').done(res => {
				let html = '<option value="">Semua Dusun</option>';
				if (Array.isArray(res)) {
					res.forEach(r => {
						html += `<option value="${r.dusun}">Dusun ${r.dusun} - ${r.nama}</option>`;
					});
				}
				$('#filterDusun').html(html);
			}).fail(() => {
				$('#filterDusun').html('<option value="">Semua Dusun</option><option value="1">Dusun 1</option><option value="2">Dusun 2</option>');
			});
		}

		/* FILTER */
		$(document).on('change', '#filterDusun', function() {
			let dusun = $(this).val();
			$.get('/api/wilayah/rw', {
				dusun
			}).done(res => {
				let html = '<option value="">Semua RW</option>';
				if (Array.isArray(res)) {
					res.forEach(r => {
						html += `<option value="${r.rw}">RW ${pad(r.rw)}</option>`;
					});
				}
				$('#filterRw').html(html);
				$('#filterRt').html('<option value="">Semua RT</option>');
				loadAll();
			}).fail(() => {
				$('#filterRw').html('<option value="">Semua RW</option><option value="1">RW 001</option>');
				$('#filterRt').html('<option value="">Semua RT</option>');
				loadAll();
			});
		});

		$(document).on('change', '#filterRw', function() {
			let dusun = $('#filterDusun').val();
			let rw = $(this).val();
			$.get('/api/wilayah/rt', {
				dusun,
				rw
			}).done(res => {
				let html = '<option value="">Semua RT</option>';
				if (Array.isArray(res)) {
					res.forEach(r => {
						html += `<option value="${r.rt}">RT ${pad(r.rt)}</option>`;
					});
				}
				$('#filterRt').html(html);
				loadAll();
			}).fail(() => {
				$('#filterRt').html('<option value="">Semua RT</option><option value="1">RT 001</option>');
				loadAll();
			});
		});

		$('#filterRt').change(loadAll);

		/* KOMPOSISI */
		async function loadKomposisi() {
			let dusun = $('#filterDusun').val();
			let rw = $('#filterRw').val();
			let rt = $('#filterRt').val();

			try {
				const res = await fetch(`/dashboard/komposisi?tahun=${DEFAULT_TAHUN}&dusun=${dusun}&rw=${rw}&rt=${rt}`);
				if (!res.ok) throw new Error('API Failed');
				const d = await res.json();
				updateChartKomposisiData(d);
			} catch (error) {
				updateChartKomposisiData({
					lunas: 75,
					belum: 20,
					bermasalah: 5
				});
			}
		}

		function updateChartKomposisiData(d) {
			if (!chartKomposisi) return;
			let total = (d.lunas || 0) + (d.belum || 0) + (d.bermasalah || 0);
			if (total === 0) {
				chartKomposisi.data.datasets[0].data = [0, 0, 0];
			} else {
				chartKomposisi.data.datasets[0].data = [
					(d.lunas / total * 100),
					(d.belum / total * 100),
					(d.bermasalah / total * 100)
				];
			}
			chartKomposisi.update();
		}

		/* TIMELINE */
		async function loadTimeline() {
			try {
				const res = await fetch(`/dashboard/timeline?tahun=${DEFAULT_TAHUN}`);
				if (!res.ok) throw new Error('API Failed');
				const data = await res.json();
				updateChartTimelineData(data);
			} catch (error) {
				updateChartTimelineData([{
						tanggal: 'Jan',
						total: 100
					}, {
						tanggal: 'Feb',
						total: 250
					},
					{
						tanggal: 'Mar',
						total: 400
					}, {
						tanggal: 'Apr',
						total: 350
					}
				]);
			}
		}

		function updateChartTimelineData(data) {
			if (!chartTimeline) return;
			chartTimeline.data.labels = data.map(x => x.tanggal);
			chartTimeline.data.datasets[0].data = data.map(x => x.total);
			chartTimeline.update();
		}

		/* RANKING */
		async function loadRanking() {
			try {
				const res = await fetch(`/dashboard/ranking-rt?tahun=${DEFAULT_TAHUN}`);
				if (!res.ok) throw new Error('API Failed');
				const data = await res.json();
				if (!Array.isArray(data)) return;
				renderRankingLists(data);
			} catch (error) {
				renderRankingLists([{
						rt_fix: '001',
						rw_fix: '002',
						alamat_rt: 'Pasirlangu',
						dataPersentase: 95.5
					},
					{
						rt_fix: '003',
						rw_fix: '001',
						alamat_rt: 'Pasirlangu',
						dataPersentase: 88.0
					},
					{
						rt_fix: '002',
						rw_fix: '003',
						alamat_rt: 'Pasirlangu',
						dataPersentase: 45.0
					},
					{
						rt_fix: '004',
						rw_fix: '001',
						alamat_rt: 'Pasirlangu',
						dataPersentase: 20.5
					}
				]);
			}
		}

		function renderRankingLists(data) {
			data.sort((a, b) => b.dataPersentase - a.dataPersentase);
			let top = '',
				bottom = '';

			data.slice(0, 10).forEach((r, idx) => {
				let p = r.dataPersentase || 0;
				let colorClass = p >= 80 ? 'text-brand-600 bg-brand-50' : p >= 50 ? 'text-amber-600 bg-amber-50' : 'text-rose-600 bg-rose-50';

				top += `
                <li class="p-3 hover:bg-slate-50 transition flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold group-hover:bg-brand-100 group-hover:text-brand-600 transition">${idx + 1}</div>
                        <div>
                            <p class="font-bold text-slate-700 text-sm">RT ${r.rt_fix} / RW ${r.rw_fix}</p>
                            <p class="text-xs text-slate-500 font-medium">${r.alamat_rt || '-'}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm px-3 py-1.5 rounded-lg ${colorClass}">${p.toFixed(2)}%</span>
                </li>`;
			});

			data.slice(-10).reverse().forEach((r, idx) => {
				let p = r.dataPersentase || 0;
				let colorClass = p >= 80 ? 'text-brand-600 bg-brand-50' : p >= 50 ? 'text-amber-600 bg-amber-50' : 'text-rose-600 bg-rose-50';

				bottom += `
                <li class="p-3 hover:bg-slate-50 transition flex items-center justify-between group">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center text-xs font-bold group-hover:bg-accent-100 group-hover:text-accent-600 transition">${idx + 1}</div>
                        <div>
                            <p class="font-bold text-slate-700 text-sm">RT ${r.rt_fix} / RW ${r.rw_fix}</p>
                            <p class="text-xs text-slate-500 font-medium">${r.alamat_rt || '-'}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm px-3 py-1.5 rounded-lg ${colorClass}">${p.toFixed(2)}%</span>
                </li>`;
			});

			if (top === '') top = '<li class="p-4 text-center text-slate-400 text-sm">Belum ada data capaian.</li>';
			if (bottom === '') bottom = '<li class="p-4 text-center text-slate-400 text-sm">Belum ada data capaian.</li>';

			$('#topList').html(top);
			$('#bottomList').html(bottom);
		}
	</script>
</body>

</html>