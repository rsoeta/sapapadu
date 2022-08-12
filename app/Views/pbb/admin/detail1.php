<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
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
                            <h3 class="card-title">Detail User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-3 col-form-label">Nama User</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Nama User" value="<?= $user['nama_user']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-3 col-form-label">No. Hape</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="No. Handphone" value="<?= $user['hp']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-3 col-form-label">Password</label>
                                    <div class="col-9">
                                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $user['password']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-3 col-form-label">Status</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="inputStatus3" placeholder="Status" value="<?= $user['status']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <a href="/admin/edit/<?= $user['id_user']; ?>"><i class="fas fa-edit fa-2x" style="margin-right: 10px;"></i></a>
                                <a href="/admin/delete/<?= $user['id_user']; ?>"><i class="fas fa-trash-alt fa-2x" onclick="return confirm('apakah anda yakin?');"></i></a>
                                <a href="/pages/user"><i class="fas fa-sign-out-alt fa-2x  float-right"></i></a>
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