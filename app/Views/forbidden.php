<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>500 Error</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
</head>

<body>

<div class="container">

	<!-- Main content -->
	<section class="content">
		<div class="error-page">
			<h2 class="headline text-danger">500</h2>
			
			<div class="error-content">
				<h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>
				
				<p>
					We will work on fixing that right away.
					Meanwhile, you may <a href="<?= base_url(); ?>">return to dashboard</a> or try using the search form.
				</p>
				
			</div>
		</div>
		<!-- /.error-page -->
		
	</section>
</div>

	<!-- jQuery -->
	<script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url('assets'); ?>/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= base_url('assets'); ?>/dist/js/demo.js"></script>
</body>

</html>