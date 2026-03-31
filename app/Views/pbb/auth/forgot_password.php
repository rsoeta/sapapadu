<?= $this->extend('pbb/auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid ">
    <div class="login-box">
        <div class="row no-margin w-100 bklmj">
            <div class="col-lg-6 col-md-6 log-det">

                <h2>Lupa Password</h2>
                <p>Masukkan data Anda untuk menerima link reset password.</p>

                <?php if (session()->get('message')): ?>
                    <div class="alert alert-warning"><?= session()->get('message'); ?></div>
                <?php endif; ?>

                <?= form_open('/forgot-password'); ?>
                <?= csrf_field(); ?>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap">
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nik" placeholder="NIK / No. KTP">
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>

                <button type="submit" class="btn btn-success btn-round">Kirim Link Reset</button>

                <?= form_close(); ?>

                <br>
                <a href="/login">Kembali ke Login</a>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>