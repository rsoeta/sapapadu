<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                            <button type="button" class="btn btn-sm btn-warning float-right" onclick="window.location='<?= site_url('/dhkp'); ?>'">
                                <i class="fa fa-backward"></i> Back
                            </button>
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- class="form-horizontal" -->
                        <form action="/admin/save" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <?= form_open_multipart('', ['class' => 'formsimpandhkp']) ?>
                                <?= csrf_field(); ?>
                                <div class="form-group row">
                                    <label for="nop" class="col-3 col-form-label">N.O.P</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('nop')) ? 'is-invalid' : ''; ?>" id="nop" name="nop" placeholder="" autofocus value="32.07.040.008.">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nop'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_wp" class="col-3 col-form-label">Nama WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_wp')) ? 'is-invalid' : ''; ?>" id="nama_wp" name="nama_wp" placeholder="" value="<?= old('nama_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat_wp" class="col-3 col-form-label">Alamat WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('alamat_wp')) ? 'is-invalid' : ''; ?>" id="alamat_wp" name="alamat_wp" placeholder="" value="<?= old('alamat_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('alamat_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bumi" class="col-3 col-form-label">Bumi</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('bumi')) ? 'is-invalid' : ''; ?>" id="bumi" name="bumi" placeholder="" value="<?= old('bumi'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bumi'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bgn" class="col-3 col-form-label">Bgn</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('bgn')) ? 'is-invalid' : ''; ?>" id="bgn" name="bgn" placeholder="" value="<?= old('bgn'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bgn'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pajak" class="col-3 col-form-label">Pajak (Rp)</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('pajak')) ? 'is-invalid' : ''; ?>" id="pajak" name="pajak" placeholder="" value="<?= old('pajak'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('pajak'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nik_wp" class="col-3 col-form-label">NIK WP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('nik_wp')) ? 'is-invalid' : ''; ?>" id="nik_wp" name="nik_wp" placeholder="" value="<?= old('nik_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nik_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_ktp" class="col-3 col-form-label">Nama KTP</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_ktp')) ? 'is-invalid' : ''; ?>" id="nama_ktp" name="nama_ktp" placeholder="" value="<?= old('nama_ktp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_ktp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dusun" class="col-3 col-form-label">Dusun</label>
                                    <div class="col-9">
                                        <select class="form-control" id="dusun" name="dusun">
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('dusun'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rw" class="col-3 col-form-label">RW</label>
                                    <div class="col-9">
                                        <select class="form-control" id="rw" name="rw">
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('rw'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rt" class="col-3 col-form-label">RT</label>
                                    <div class="col-9">
                                        <select class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ''; ?> " id="rt" name="rt" value="<?= old('rt'); ?>">
                                        </select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('rt'); ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket" class="col-3 col-form-label">Keterangan</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control <?= ($validation->hasError('ket')) ? 'is-invalid' : ''; ?>" id="ket" name="ket" placeholder="" value="BELUM BAYAR">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ket'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-success" style="margin-right: 10px;">
                                            <i class="fas fa-check fa-sm"></i>
                                        </button>
                                        <button type="submit" class="btn btn-warning tombolsave">
                                            <i class="fas fa-undo-alt center fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function dataDusun() {
        $('#dusun').select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: '--Cari Dusun--',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('dhkp/ambilDataDusun') ?>",
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                }
            }
        });

        $('#dusun').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('dhkp/ambilDataRw'); ?>",
                data: {
                    dusun: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#rw').html(response.data);
                        $('#rw').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    }
    $(document).ready(function() {
        dataDusun();
    });
</script>

<?= $this->endsection(); ?>