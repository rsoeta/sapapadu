<?= $this->extend('pbb/auth/templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid ">
    <div class="login-box">
        <div class="row no-margin w-100 bklmj">
            <div class="col-lg-6 col-md-6 log-det">

                <h2>Reset Password</h2>

                <?php if (session()->get('message')): ?>
                    <div class="alert alert-warning"><?= session()->get('message'); ?></div>
                <?php endif; ?>

                <?= form_open('/reset-password'); ?>
                <?= csrf_field(); ?>

                <input type="hidden" name="token" value="<?= $token ?>">

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="pu_password" placeholder="Password Baru">
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm" id="pass_confirm" placeholder="Confirm Password">
                </div>
                <!-- checkbox -->
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Tampilkan Password</label>
                </div>

                <button type="submit" class="btn btn-success btn-round">Reset Password</button>

                <?= form_close(); ?>

                <br>
                <a href="/login">Kembali ke Login</a>

            </div>
        </div>
    </div>
</div>
<script>
    var show = document.getElementById("customCheck1")
    show.addEventListener('click', function() {
        if (pu_password.type === "password" && pass_confirm.type === "password") {
            pu_password.type = "text";
            pass_confirm.type = "text";
        } else {
            pu_password.type = "password";
            pass_confirm.type = "password";
        }
    })
</script>
<?= $this->endSection(); ?>