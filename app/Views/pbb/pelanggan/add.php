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
                <div class="col-sm-7">
                    <!-- general form elements -->
                    <!-- /.card -->
                    <!-- Horizontal Form -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <button type="button" class="btn btn-sm btn-secondary float-right" onclick="goBack()">
                                <i class="fa fa-backward"></i> Back
                            </button>
                            <h3 class="card-title"><?= $title; ?></h3>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('', ['class' => 'formsimpan']) ?>
                            <?= csrf_field(); ?>
                            <div class="form-group row">
                                <label for="nik" class="col-4 col-form-label">NIK Pelanggan</label>
                                <div class="col-6 col-sm-6">
                                    <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= old('nik'); ?>">
                                    <div class="errorNik" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_pelanggan" class="col-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-8">
                                    <input type="text" class="form-control <?= ($validation->hasError('nama_pelanggan')) ? 'is-invalid' : ''; ?>" id="nama_pelanggan" name="nama_pelanggan" value="<?= old('nama_pelanggan'); ?>">
                                    <div class="errorNamapelanggan" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dusun" class="col-4 col-form-label">Nama Kadus</label>
                                <div class="col-6 col-sm-6">
                                    <select class="form-control" id="dusun" name="dusun"></select>
                                    <div class="errorDusun" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-primary tombolTambahDusun">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rw" class="col-4 col-form-label">Nama Ketua RW</label>
                                <div class="col-6 col-sm-6">
                                    <select class="form-control" id="rw" name="rw"></select>
                                    <div class="errorRw" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-primary tombolTambahRw">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rt" class="col-4 col-form-label">Nama Ketua RT</label>
                                <div class="col-6 col-sm-6">
                                    <select class="form-control <?= ($validation->hasError('rt')) ? 'is-invalid' : ''; ?> " id="rt" name="rt" value="<?= old('rt'); ?>"></select>
                                    <div class="errorRt" style="display: none;">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-sm btn-primary tombolTambahRt">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary float-right tombolSave" style="margin-right: 10px;">
                                        <i class="fas fa-plus fa-sm"></i> Simpan
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
    function goBack() {
        window.history.back();
    }

    function dataDusun() {

        //pilih data dusun
        $('#dusun').select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: '--Pilih Kadus--',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('dhkp22/ambilDataDusun'); ?>",
                delay: 250,
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
                url: "<?= site_url('dhkp22/ambilDataRw'); ?>",
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
                url: "<?= site_url('dhkp22/ambilDataRt'); ?>",
                data: {
                    dusun: $(this).val(),
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
                url: "<?= site_url('wilayah/formtambahdusun'); ?>",
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
                url: "<?= site_url('wilayah/formtambahrw'); ?>",
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
                url: "<?= site_url('wilayah/formtambahrt'); ?>",
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

            let form = $('.formsimpan')[0];

            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('pelanggan/simpandata'); ?>",
                data: data,
                dataType: "json",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function(e) {
                    $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.tombolSave').prop('disabled', true);
                },
                complete: function() {
                    $('.tombolSave').html('Simpan');
                    $('.tombolSave').prop('disabled', true);
                },
                success: function(response) {
                    if (response.error) {
                        let dataError = response.error;
                        if (dataError.errorNik) {
                            $('.errorNik').html(dataError.errorNik).show();
                            $('#nik').addClass('is-invalid');
                        } else {
                            $('.errorNik').fadeOut();
                            $('#nik').removeClass('is-invalid');
                            $('#nik').addClass('is-valid');
                        }
                        if (dataError.errorNamapelanggan) {
                            $('.errorNamapelanggan').html(dataError.errorNamapelanggan).show();
                            $('#nama_pelanggan').addClass('is-invalid');
                        } else {
                            $('.errorNamapelanggan').fadeOut();
                            $('#nama_pelanggan').removeClass('is-invalid');
                            $('#nama_pelanggan').addClass('is-valid');
                        }
                        if (dataError.errorDusun) {
                            $('.errorDusun').html(dataError.errorDusun).show();
                            $('#dusun').addClass('is-invalid');
                        } else {
                            $('.errorDusun').fadeOut();
                            $('#dusun').removeClass('is-invalid');
                            $('#dusun').addClass('is-valid');
                        }
                        if (dataError.errorRw) {
                            $('.errorRw').html(dataError.errorRw).show();
                            $('#rw').addClass('is-invalid');
                        } else {
                            $('.errorRw').fadeOut();
                            $('#rw').removeClass('is-invalid');
                            $('#rw').addClass('is-valid');
                        }
                        if (dataError.errorRt) {
                            $('.errorRt').html(dataError.errorRt).show();
                            $('#rt').addClass('is-invalid');
                        } else {
                            $('.errorRt').fadeOut();
                            $('#rt').removeClass('is-invalid');
                            $('#rt').addClass('is-valid');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: response.sukses,
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

    });
</script>

<?= $this->endsection(); ?>