<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->

    <section class="content">
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('pesan'); ?>
            </div>

        <?php endif; ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Admin & User</h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="card-header">
                                <a href="/pbb/admin/create" class="">
                                    <i class="fas fa-plus-square fa-2x"></i>
                                </a>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" placeholder="Search" name="cariuser" autofocus>
                                        <div class="input-group-append">
                                            <div class="btn btn-primary">
                                                <!-- <button class="btn btn-outline-primary" type="submit" name="tomboluser">Search</button> -->
                                                <i class="fas fa-search" type="submit" name="tomboluser"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-tools -->
                            </div>

                            <table id="example2" class="table table-bordered table-hover mt-1">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>No</th>
                                        <th class="d-none">ID User</th>
                                        <th>Nama User(s)</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($user as $u) : ?>
                                        <tr>
                                            <td>
                                                <a href="/pbb/admin/detail/<?= $u['id']; ?>">
                                                    <i class="fas fa-info-circle fa-lg fa-fw"></i>
                                                </a>
                                            </td>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td class="d-none"><?= $u['id']; ?></td>
                                            <td><?= $u['fullname']; ?></td>
                                            <td><?= $u['level']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endsection(); ?>