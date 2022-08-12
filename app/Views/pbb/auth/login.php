<?= $this->extend('pbb/auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid ">


    <div class="no-pdding login-box">
        <div class="row no-margin w-100 bklmj">
            <div class="col-lg-6 col-md-6 log-det">

                <h2><?= $title; ?></h2>

                <!-- pesan validasi sukses register -->


                <div class="row no-margin past">
                    <a href="/register">
                        <p>Don't Have an Account? Create your Account</p>
                    </a>
                </div>

                <?php
                if (session()->get('success')) { ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success'); ?>
                    </div>
                <?php } ?>

                <!-- pesan validasi sukses register -->
                <?php
                if (session()->get('message')) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?= session()->get('message'); ?>
                    </div>
                <?php } ?>

                <!-- pesan validasi error -->
                <?php $errors = session()->get('errors');
                if (!empty($errors)) { ?>

                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                <?php } ?>
                <?= form_open('/login'); ?>
                <?= csrf_field() ?>


                <div class="form-group text-box-cont">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>


                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>


                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="remember" class="form-check-input">
                            Remember Me
                        </label>
                    </div>


                    <div class="right-bkij my-2">
                        <button type="submit" class="btn btn-success btn-round">Login</button>
                    </div>

                </div>
                <?= form_close(); ?>
                <br><br>
                <hr class="mt-2">
                <div class="row no-margin past mt-2 float-right">
                    <a href="<?= base_url(); ?>" style="color: blue;">
                        <p>Back to Home</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 box-de">
                <div class="ditk-inf">
                    <h2 class="w-100">Welcome Back</h2>
                    <p>Simply Create your account by <br> clicking the Signup Button</p>
                    <button type="button" class="btn btn-outline-light"><a href="/register">Sign Up</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection(); ?>