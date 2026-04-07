<?= $this->extend('pbb/auth/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid">
    <div class="no-pdding login-box">
        <div class="row no-margin w-100 bklmj">

            <!-- LEFT SIDE (FORM) -->
            <div class="col-lg-6 col-md-6 log-det">

                <h2>Ganti Password</h2>

                <p class="mb-3 text-muted">
                    Silakan buat password baru untuk melanjutkan
                </p>

                <!-- ERROR -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="/change-password">

                    <?= csrf_field() ?>

                    <div class="form-group text-box-cont">

                        <!-- PASSWORD -->
                        <div class="input-group mb-3">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Password Baru"
                                required>
                        </div>

                        <!-- CONFIRM -->
                        <div class="input-group mb-3">
                            <input
                                type="password"
                                name="pass_confirm"
                                id="pass_confirm"
                                class="form-control"
                                placeholder="Konfirmasi Password"
                                required>
                        </div>

                        <!-- SHOW PASSWORD -->
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="showPass">
                            <label class="custom-control-label" for="showPass">
                                Tampilkan Password
                            </label>
                        </div>

                        <!-- BUTTON -->
                        <div class="right-bkij my-2">
                            <input
                                type="submit"
                                value="Simpan Password"
                                class="btn btn-success btn-round w-100">
                        </div>

                    </div>

                </form>

            </div>

            <!-- RIGHT SIDE (INFO PANEL) -->
            <div class="col-lg-6 col-md-6 box-de">
                <div class="ditk-inf">
                    <h2 class="w-100">Keamanan Akun</h2>
                    <p>
                        Demi keamanan, silakan gunakan password yang kuat dan tidak mudah ditebak.
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

<?php if (session()->getFlashdata('sukses')): ?>
    <script>
        showToastSuccess("<?= session()->getFlashdata('sukses') ?>");
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        showToastError("<?= session()->getFlashdata('error') ?>");
    </script>
<?php endif; ?>

<script>
    // toggle password
    document.getElementById('showPass').addEventListener('click', function() {
        let p1 = document.getElementById('password');
        let p2 = document.getElementById('pass_confirm');

        let type = (p1.type === 'password') ? 'text' : 'password';
        p1.type = type;
        p2.type = type;
    });
</script>

<?= $this->endSection(); ?>