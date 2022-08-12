<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= namaApp(); ?> | Lockscreen</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/dist/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <h3><?= $title; ?></h3>
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?= namaApp(); ?> | Lockscreen</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="<?= base_url('assets'); ?>/dist/img/access-denied.png" alt="User Image">
      </div>
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials">
        <div class="input-group">
          <label class="form-control">Please Login before!

            <a href="<?= base_url('/logout'); ?>" type="button" class="btn">
              <i class="fas fa-arrow-right text-muted"></i>
            </a>
            <div class="input-group-append">
            </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->

    <div class="text-center">
      <a href="<?= base_url('/logout'); ?>"">Or sign in as a different user</a>
  </div>
  <div class=" lockscreen-footer text-center">
        Copyright &copy; 2021 - <?php echo date('Y') ?> <b><a href="<?= base_url('dtks'); ?>" class="text-black"><?= namaApp(); ?></a></b><br>
        All rights reserved
    </div>
  </div>
  <!-- /.center -->

  <!-- jQuery -->
  <script src="<?= base_url('assets'); ?>/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('assets'); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>