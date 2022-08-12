<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- autoNumericPajak -->
<script src="<?= base_url('assets/plugins/autoNumeric-c426664/autoNumeric.js'); ?>"></script>

<div class="content-wrapper mt-1">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-sm-6">
                    <!-- general form elements -->
                    <!-- /.card -->
                    <!-- Horizontal Form -->
                    <div class="card card-success">
                        <div class="card-header">
                            <button type="button" class="btn btn-sm btn-secondary float-right" onclick="window.location='<?= site_url('/pbb/dhkp21'); ?>'">
                                <i class="fa fa-backward"></i> Back
                            </button>
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- class="form-horizontal" -->
                        <form action="/admin/save" method="POST" enctype="multipart/form-data" style="margin:0px; padding:0px; display:inline;">
                            <div class="card-body">
                                <?= form_open_multipart('', ['class' => 'formsimpandhkp']) ?>
                                <?= csrf_field(); ?>
                                <div class="form-group form-group-sm row nopadding">
                                    <label for="nop" class="col-4 col-form-label">N.O.P</label>
                                    <div class="col-8 col-sm-5 ">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nop')) ? 'is-invalid' : ''; ?>" id="nop" name="nop" placeholder="" autofocus value="32.07.040.008.">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nop'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="nama_wp" class="col-4 col-form-label">Nama WP</label>
                                    <div class="col-8 ">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nama_wp')) ? 'is-invalid' : ''; ?>" id="nama_wp" name="nama_wp" placeholder="" value="<?= old('nama_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="alamat_wp" class="col-4 col-form-label">Alamat WP</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('alamat_wp')) ? 'is-invalid' : ''; ?>" id="alamat_wp" name="alamat_wp" placeholder="" value="<?= old('alamat_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('alamat_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="bumi" class="col-4 col-form-label">Bumi</label>
                                    <div class="col-8 col-sm-3">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('bumi')) ? 'is-invalid' : ''; ?>" id="bumi" name="bumi" placeholder="" value="<?= old('bumi'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bumi'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="bgn" class="col-4 col-form-label">Bgn</label>
                                    <div class="col-8 col-sm-3">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('bgn')) ? 'is-invalid' : ''; ?>" id="bgn" name="bgn" placeholder="" value="<?= old('bgn'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('bgn'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="" class="col-4 col-form-label">Pajak (Rp)</label>
                                    <div class="col-8 col-sm-3">
                                        <input type="text" class="form-control form-control-sm" id="pajak" name="pajak" value="<?= old('pajak'); ?>" style="text-align: right;">
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="nik_wp" class="col-4 col-form-label">NIK WP</label>
                                    <div class="col-8 col-sm-5">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nik_wp')) ? 'is-invalid' : ''; ?>" id="nik_wp" name="nik_wp" placeholder="" value="<?= old('nik_wp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nik_wp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="nama_ktp" class="col-4 col-form-label">Nama KTP</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('nama_ktp')) ? 'is-invalid' : ''; ?>" id="nama_ktp" name="nama_ktp" placeholder="" value="<?= old('nama_ktp'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('nama_ktp'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="dusun" class="col-4 col-form-label">Dusun</label>
                                    <div class="col-8 col-sm-8">
                                        <select class="form-control form-control-sm" id="dusun" name="dusun"></select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('dusun'); ?>
                                    </div>
                                    <div class="col-2" style="display: none;">
                                        <button type="button" class="btn btn-sm btn-primary tombolTambahDusun">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="rw" class="col-4 col-form-label">RW</label>
                                    <div class="col-8 col-sm-8">
                                        <select class="form-control form-control-sm" id="rw" name="rw"></select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('rw'); ?>
                                    </div>
                                    <div class="col-2" style="display: none;">
                                        <button type="button" class="btn btn-sm btn-primary tombolTambahRw">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="rt" class="col-4 col-form-label">RT</label>
                                    <div class="col-8 col-sm-8">
                                        <select class="form-control form-control-sm <?= ($validation->hasError('rt')) ? 'is-invalid' : ''; ?> " id="rt" name="rt" value="<?= old('rt'); ?>"></select>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('rt'); ?>
                                    </div>
                                    <div class="col-2" style="display: none;">
                                        <button type="button" class="btn btn-sm btn-primary tombolTambahRt">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <label for="ket" class="col-4 col-form-label">Keterangan</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control form-control-sm <?= ($validation->hasError('ket')) ? 'is-invalid' : ''; ?>" id="ket" name="ket" placeholder="" value="BELUM BAYAR" readonly>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('ket'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row nopadding">
                                    <div class="col-3">
                                    </div>
                                    <div class="col-8">
                                        <button type="" class="btn btn-warning tombolSave">
                                            <i class="fas fa-undo-alt center fa-sm"></i>
                                        </button>
                                        <button type="submit" class="btn btn-success float-right" style="margin-right: 10px;">
                                            <i class="fas fa-check fa-sm"></i>
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

<div class="viewmodal" style="display: none;"></div>

<script>
    function dataDusun() {

        //pilih data dusun
        $('#dusun').select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: '--Pilih Kadus--',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('pbb/dhkp21/ambilDataDusun'); ?>",
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

        // pilih data rw
        $('#dusun').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('pbb/dhkp21/ambilDataRw'); ?>",
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

        // pilih data rt
        $('#rw').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('pbb/dhkp21/ambilDataRt'); ?>",
                data: {
                    rw: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#rt').html(response.data);
                        $('#rt').select2();
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

        $('.tombolTambahDusun').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pbb/wilayah/formtambahdusun'); ?>",
                dataType: "json",
                type: "post",
                data: {
                    aksi: 1
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahdusun').on('shown.bs.modal', function(event) {
                            $('#no_dusun').focus();
                        });
                        $('#modaltambahdusun').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tombolTambahRw').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pbb/wilayah/formtambahrw'); ?>",
                dataType: "json",
                type: "post",
                data: {
                    aksi: 1
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahrw').on('shown.bs.modal', function(event) {
                            $('#no_rw').focus();
                        });
                        $('#modaltambahrw').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tombolTambahRt').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pbb/wilayah/formtambahrt'); ?>",
                dataType: "json",
                type: "post",
                data: {
                    aksi: 1
                },
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahrt').on('shown.bs.modal', function(event) {
                            $('#no_rt').focus();
                        });
                        $('#modaltambahrt').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tombolSave').click(function(e) {
            e.preventDefault();

            let form = $('.formsimpandhkp')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('pbb/dhkp21/simpandatadhkp'); ?>",
                data: "data",
                dataType: "json",

                success: function(response) {

                }
            });
        });

        $('#pajak').autoNumeric('init', {
            aSep: ',',
            aDec: '.',
            mDec: '2'
        });

    });
</script>

<?= $this->endsection(); ?>