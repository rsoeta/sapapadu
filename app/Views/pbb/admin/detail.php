<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="card mb-3" style="max-width: 750px;">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center text-uppercase" style="text-decoration: underline;"><strong><?= $title; ?></strong></p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="/img/<?= $user['pu_user_image']; ?>" class="card-img" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="row-md-8">
                                    <div class="row my-1">
                                        <div class="col-sm-3">
                                            <label for="fullname" class="col col-form-label">Nama User</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control d-inline" id="fullname" placeholder="Nama User" value="<?= $user['pu_fullname']; ?>">
                                        </div>
                                    </div>
                                    <?php if (detailUser()->pu_role_id == 1) { ?>
                                        <div class="row my-1">
                                            <div class="col-md-3">
                                                <label for="level" class="col col-form-label">Level</label>
                                            </div>
                                            <div class="col-md-8">
                                                <select name="level" id="" class="form-control d-inline">
                                                    <option value="">--Pilih Level--</option>
                                                    <?php foreach ($roles as $r => $val) : ?>
                                                        <option value="<?= $val->id_role; ?>" <?= $val->id_role == $user['pu_role_id'] ? 'selected' : ''; ?>><?= $val->nm_role; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <!-- /.card-footer -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/admin/edit/<?= $user['pu_id']; ?>"><i class="fas fa-edit fa-2x" style="margin-right: 10px;"></i></a>
                                <a href="/admin/delete/<?= $user['pu_id']; ?>"><i class="fas fa-trash-alt fa-2x" onclick="return confirm('apakah anda yakin?');"></i></a>
                                <a href="/pages/user"><i class="fas fa-sign-out-alt fa-2x  float-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endsection(); ?>