<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper mt-1">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-12">
                    <!-- general form elements -->
                    <!-- /.card -->
                    <!-- Horizontal Form -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- class="form-horizontal" -->
                        <form action="/admin/save" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= csrf_field(); ?>
                                <div class="form-group row">
                                    <label for="nama_user" class="col-3 col-form-label">Nama User</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?>" id="nama_user" name="nama_user" placeholder="" autofocus value="<?= old('nama_user'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_user'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hp" class="col-3 col-form-label">No. Hape</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('hp')) ? 'is-invalid' : ''; ?>" id="hp" name="hp" placeholder="" value="<?= old('hp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('hp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-3 col-form-label">Password</label>
                                    <div class="col-9">
                                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="" value="<?= old('password'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-3 col-form-label">Status</label>
                                    <div class="col-9">
                                        <select class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?> " id="status" name="status" value="<?= old('status'); ?>">
                                            <option value="" selected> --Pilih Status--</option>
                                            <option value="Admin">Admin</option>
                                            <option value="User">User</option>
                                            <option value="Guest">Guest</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('status'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="foto" class="col-3 col-form-label">Foto</label>
                                    <div class="col-2">
                                        <img src="/img/default.png" class="img-thumbnail img-preview">
                                    </div>
                                    <div class="col-7">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" onchange="previewImg()">
                                            <?= $validation->getError('foto'); ?>
                                        </div>
                                        <label class="custom-file-label" for="foto">Pilih Gambar..</label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px;">
                            <i class="fas fa-check fa-lg"></i>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-undo-alt center fa-lg"></i>
                        </button>
                        <a href="/admin"><i class="fas fa-sign-out-alt float-right fa-2x"></i></a>
                    </div>
                    <!-- /.card-footer -->

                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
</div>
</section>
</div>
<?= $this->endsection(); ?>