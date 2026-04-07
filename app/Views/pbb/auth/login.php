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

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <!-- <?= form_open('/login'); ?> -->
                <!-- <form method="post" action="/login"> -->
                <form method="post" action="/login" id="formLogin">
                    <?= csrf_field() ?>


                    <div class="form-group text-box-cont">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>


                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" id="pu_password">
                        </div>


                        <!-- checkbox -->
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Tampilkan Password</label>
                        </div>

                        <div class="right-bkij my-2">
                            <!-- <button type="submit" class="btn btn-success btn-round" onclick="alert('klik login')">Login</button> -->
                            <input type="submit" value="Login" class="btn btn-success btn-round">
                        </div>

                    </div>
                    <!-- <?= form_close(); ?> -->

                </form>
                <br><br>
                <hr class="mt-2">
                <div class="row no-margin past d-flex justify-content-between">

                    <div class="col-auto p-0">
                        <a href="/forgot-password" style="color: blue;">
                            <p class="m-0">Lupa Password?</p>
                        </a>
                    </div>

                    <div class="col-auto p-0 text-right">
                        <a href="<?= base_url(); ?>" style="color: blue;">
                            <p class="m-0">Back to Home</p>
                        </a>
                    </div>

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
    // show password
    var pu_password = document.getElementById("pu_password")
    var show = document.getElementById("customCheck1")
    show.addEventListener('click', function() {
        if (pu_password.type === "password") {
            pu_password.type = "text";
        } else {
            pu_password.type = "password";
        }
    })

    // fade out alert
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<script>
    document.getElementById('formLogin').addEventListener('submit', function() {
        console.log('FORM BENAR-BENAR SUBMIT');
    });
</script>
<?= $this->endSection(); ?>