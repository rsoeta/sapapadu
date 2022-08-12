<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <section class="content">

        <div class="card mb-3" style="max-width: 750px;">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center text-uppercase" style="text-decoration: underline;"><strong><?= $title; ?></strong></p>
                </div>
            </div>
            <div class="row g-0">

                <div class="col-md-8">
                    <div class="row-md-8">
                        <div class="row my-1">
                            <div class="col-sm-3">
                                <label for="nama_wp" class="col col-form-label ">Nama</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control d-inline" id="nama_wp" placeholder="Nama User" value="<?= $dhkp['nama_wp']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="alamat_wp" class="col col-form-label ">Alamat WP</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="alamat_wp" placeholder="Alamat WP" value="<?= $dhkp['alamat_wp']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="alamat_op" class="col col-form-label ">Alamat OP</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="alamat_op" placeholder="Alamat op" value="<?= $dhkp['alamat_op']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="bumi" class="col col-form-label ">Bumi</label>
                            </div>
                            <div class="col-md-8">
                                <input type="num" class="form-control d-inline" id="bumi" placeholder="bumi" value="<?= number_format($dhkp['bumi'], 0, ',', '.'); ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="pajak" class="col col-form-label ">Pajak</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="pajak" placeholder="pajak" value="<?= number_format($dhkp['pajak'], 00, '.', '.'); ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="nik_wp" class="col col-form-label ">NIK WP</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="nik_wp" placeholder="nik_wp" value="<?= $dhkp['nik_wp']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="nama_ktp" class="col col-form-label ">Nama WP</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="nama_ktp" placeholder="nama_ktp" value="<?= $dhkp['nama_ktp']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="dusun" class="col col-form-label ">Dusun</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="dusun" placeholder="dusun" value="<?= $dhkp['dusun']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="rw" class="col col-form-label ">RW</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="rw" placeholder="rw" value="<?= $dhkp['rw']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="rt" class="col col-form-label ">RT</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="rt" placeholder="rt" value="<?= $dhkp['rt']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-3">
                                <label for="ket" class="col col-form-label ">Keterangan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control d-inline" id="ket" placeholder="ket" value="<?= $dhkp['ket']; ?>" disabled='disabled'>
                            </div>
                        </div>
                        <br>
                        <div class="card-footer">
                            <a href="/dhkp/edit/<?= $dhkp['id']; ?>"><i class="fas fa-edit fa-2x" style="margin-right: 10px;"></i></a>
                            <a href="/dhkp/delete/<?= $dhkp['id']; ?>"><i class="fas fa-trash-alt fa-2x" onclick="return confirm('apakah anda yakin?');"></i></a>
                            <a href="/dhkp"><i class="fas fa-sign-out-alt fa-2x  float-right"></i></a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</div>

<?= $this->endsection(); ?>