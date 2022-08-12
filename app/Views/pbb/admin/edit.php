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
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- class="form-horizontal" -->
                        <form action="/pbb/admin/update/<?= $user['id']; ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="card-body">
                                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                                <input type="hidden" name="fotoLama" value="<?= $user['user_image']; ?>">
                                <div class="form-group row">
                                    <label for="fullname" class="col-4 col-form-label">Nama</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control <?= ($validation->hasError('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" placeholder="" autofocus value="<?= (old('fullname')) ? old('fullname') : $user['fullname']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('fullname'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-4 col-form-label">Password</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="" value="<?= (old('password')) ? old('password') : $user['password']; ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if (session()->get('level') > 1) { ?>
                                    <div class="form-group row">
                                        <label for="level" class="col-4 col-form-label">Level</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" id="level" name="level" placeholder="" value="<?= (old('level')) ? old('level') : $user['level']; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('level'); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="form-group row">
                                    <label for="user_image" class="col-4 col-form-label">Foto User</label>
                                    <div class="col-8">
                                        <div class="col-4">
                                            <img src="/img/<?= $user['user_image']; ?>" class="img-thumbnail img-preview">
                                        </div>
                                        <div class="col-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?= ($validation->hasError('user_image')) ? 'is-invalid' : ''; ?>" id="user_image" name="user_image" onchange="previewImg()">
                                                <?= $validation->getError('user_image'); ?>
                                            </div>
                                            <label class="custom-file-label" for="user_image"><?= $user['user_image']; ?></label>
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
                                <a href="/pbb/admin"><i class="fas fa-sign-out-alt float-right fa-2x"></i></a>
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