<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper mt-1">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-lg-12">
                <b>
                    <h5 style="text-align: center;" class=>Form. Tambah Data</h5>
                </b>
                <hr>
                <form action="/pbb/dhkp21/save" method="POST" enctype="multipart/form-data">
                    <?php
                    if (count($data) > 0) {
                        foreach ($data as $n) {
                    ?>
                            <div class="">
                                <?= csrf_field(); ?>
                                <div class="form-group row">
                                    <label for="nop" class="col-3 col-form-label" style="text-align: right;">NO. OP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control " id="nop" name="nop" placeholder="" value=" <?= $n['nop']; ?>" autofocus>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_wp" class="col-3 col-form-label" style="text-align: right;">NAMA PEMILIK</label>
                                    <div class="col-9">
                                        <input style="font-weight:bold;" type=" text" class="form-control " id="nama_wp" name="nama_wp" placeholder="" value=" <?= $n['nama_wp']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_wp" class="col-3 col-form-label" style="text-align: right;">ALAMAT WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="alamat_wp" name="alamat_wp" placeholder="" value="<?= $n['alamat_wp']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_op" class="col-3 col-form-label" style="text-align: right;">ALAMAT OP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="alamat_op" name="alamat_op" placeholder="" value="<?= $n['alamat_op']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bumi" class="col-3 col-form-label" style="text-align: right;">BUMI</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="bumi" name="bumi" placeholder="" value="<?= $n['bumi']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bgn" class="col-3 col-form-label" style="text-align: right;">BANGUNAN</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="bgn" name="bgn" placeholder="" value="<?= $n['bgn']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pajak" class="col-3 col-form-label" style="text-align: right;">PAJAK (Rp)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="pajak" name="pajak" placeholder="" value="<?= $n['pajak']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik_wp" class="col-3 col-form-label" style="text-align: right;">NIK WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="nik_wp" name="nik_wp" placeholder="" value="<?= $n['nik_wp']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_ktp" class="col-3 col-form-label" style="text-align: right;">NAMA W. PAJAK</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="nama_ktp" name="nama_ktp" placeholder="" value="<?= $n['nama_ktp']; ?>">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dusun" class="col-3 col-form-label" style="text-align: right;">DUSUN</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="dusun" name="dusun" placeholder="" value="<?= $n['dusun']; ?>">
                                    </div>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rw" class="col-3 col-form-label" style="text-align: right;">RW</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="rw" name="rw" placeholder="" value="<?= $n['rw']; ?>">
                                    </div>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rt" class="col-3 col-form-label" style="text-align: right;">RT</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="rt" name="rt" placeholder="" value="<?= $n['rt']; ?>">
                                    </div>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="form-group row">
                                    <label for="ket" class="col-3 col-form-label" style="text-align: right;">KETERANGAN</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="ket" name="ket" placeholder="" value="BELUM BAYAR">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <a class="btn btn-secondary" href="/dhkp21" role="button">Back</a>
                                        <button type="submit" class="btn btn-success float-right">
                                            <i class="fas fa-check fa-sm"></i> Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-danger">
                            <h5 style="text-align: center;">--Data Tidak Ditemukan--</h5>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <a class="btn btn-secondary" href="/pbb/dhkp21" role="button">Back</a>
                            </div>
                        </div>
                    <?php
                    }

                    ?>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>


<?= $this->endsection(); ?>