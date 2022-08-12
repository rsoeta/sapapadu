<?= $this->extend('pbb/auth/templates/index'); ?>

<?= $this->section('content'); ?>
<style>
    #pu_kode_desa,
    #pu_level {
        display: none;
    }
</style>
<div class="container-fluid ">

    <div class=" no-pdding login-box">
        <div class="row no-margin w-100 bklmj">
            <div class="col-lg-6 col-md-6 log-det">

                <h2 class="mb-2">Register</h2>
                <div class="row no-margin past">
                    <p>Already Registered? <a href="<?= base_url('/login'); ?>">Login</a></p>
                </div>
                <?php if (session()->get('success')) : ?>
                    <div class="col-12 mb-2" style="background-color: darkorange; border-radius: 3px; padding: 10px;">
                        <div class="alert alert-success text-success" role="alert">
                            <?= session()->get('success'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (session()->get('message')) : ?>
                    <div class="col-12 mb-2" style="background-color: darkorange; border-radius: 3px; padding: 10px;">
                        <div class="alert alert-success text-danger" role="alert">
                            <?= session()->get('message'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (isset($validation)) : ?>
                    <div class="col-12 mb-2" style="background-color: darkorange; border-radius: 3px; padding: 10px; color: black;">
                        <div class="col">
                            <div class="container">
                                <?= $validation->listErrors(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?= form_open('/register'); ?>
                <?= csrf_field(); ?>
                <div class="text-box-cont">
                    <!-- dropdown -->
                    <div class="input-group padding01">
                        <select class="form-control form-control-user" id="pu_role_id" name="pu_role_id" onchange="admSelectCheck(this);">
                            <option value="">Pilih Jabatan</option>
                            <option value="2">Kolektor Desa</option>
                            <option value="3">Kepala Dusun</option>
                        </select>
                    </div>
                    <div class="input-group padding01" id="pu_kode_desa">
                        <select class="form-control form-control-user" name="pu_kode_desa">
                            <option value="">Pilih Desa</option>
                            <?php foreach ($desa as $d) : ?>
                                <option value="<?= $d['id']; ?>"><?= ucwords(strtolower($d['name'])); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group padding01" id="pu_level">
                        <input type="number" class="form-control form-control-user" value="<?= set_value('pu_level') ?>" placeholder="No. Dusun" name="pu_level">
                    </div>
                    <div class="input-group padding01">
                        <input type="text" class="form-control form-control-user" value="<?= set_value('pu_fullname') ?>" placeholder="Nama Lengkap" name="pu_fullname">
                    </div>
                    <div class="input-group padding01">
                        <input type="numeric" class="form-control form-control-user" value="<?= set_value('pu_nik') ?>" placeholder="NIK / No. KTP" name="pu_nik">
                    </div>
                    <div class="input-group padding01">
                        <input type="email" class="form-control form-control-user" placeholder="Email" name="pu_email" value="<?= set_value('pu_email'); ?>" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3 col-6 mb-sm-0 ">
                            <input type="password" class="form-control form-control-user" placeholder="Password" name="pu_password" id="pu_password" autocomplete="off">
                        </div>
                        <div class="input-group mb-3 col-6 mb-sm-0">
                            <input type="password" class="form-control form-control-user" placeholder="Confirm Password" name="pass_confirm" id="pass_confirm" autocomplete="off">
                        </div>
                    </div>
                    <div class="right-bkij mb-5">
                        <!-- checkbox -->
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Tampilkan Password</label>
                        </div>
                        <button type="submit" class="btn btn-success btn-round">Sign Up</button>
                    </div>
                </div>

                <?= form_close(); ?>
            </div>
            <div class="col-lg-6 col-md-6 box-de">
                <div class="ditk-inf">
                    <h2 class="w-100">Welcome Back</h2>
                    <h6 style="color: black;">Simply login to your account by <br> clicking the Signin Button</h6>
                    <a href="<?= base_url('/login'); ?>">
                        <button type="button" class="btn btn-outline-light">Sign In</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // show password
    var pu_password = document.getElementById("pu_password")
    var pass_confirm = document.getElementById("pass_confirm")
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

    function admSelectCheck(nameSelect) {
        var valueSelect = nameSelect.value;
        if (valueSelect == 2) {
            document.getElementById("pu_kode_desa").style.display = "flex";
            document.getElementById("pu_level").style.display = "none";
        } else if (valueSelect == 3) {
            document.getElementById("pu_kode_desa").style.display = "flex";
            document.getElementById("pu_level").style.display = "flex";
        } else {
            document.getElementById("pu_kode_desa").style.display = "none";
            document.getElementById("pu_level").style.display = "none";
        }
    }

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 3000);
</script>
<?= $this->endSection(); ?>