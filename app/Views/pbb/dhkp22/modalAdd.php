<!-- jquery cdn -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->


<!-- jQuery -->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="modalTambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahdhkpLabel"><?= $title; ?></h5>
            </div>
            <?= form_open('', ['class' => 'formsimpan']) ?>
            <div class="modal-body">
                <div class="form-group row nopadding mb-2">
                    <label class="col-4 col-sm-2 col-md-2 col-form-label" for="dataCari">Cari Data</label>
                    <div class="col-8 col-sm-10 col-md-10">
                        <select name="dd_country" id="dd_country" class="form-control form-control-sm" style="width: 300px;">
                            <option value='0'>-- Select --</option>
                        </select>
                    </div>
                </div>
                <hr style="height:2px;border-width:0;color:dark;background-color:dark">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <div class="form-group row nopadding" <?= ($pu_role_id > 1) ? 'style="display:none;"' : ''; ?>>
                            <label class="col-4 col-form-label" for="pd_desa">Desa</label>
                            <div class="col-8">
                                <select name="pd_desa" id="pd_desa" class="form-control form-control-sm">
                                    <option value="">-Pilih Desa-</option>
                                    <?php foreach ($data_desa as $row) : ?>
                                        <option <?= (detailUser()->pu_kode_desa == $row['id']) ? 'selected' : ''; ?> value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorpd_desa"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="pajak">Pajak</label>
                            <div class="col-8">
                                <input type="number" name="pajak" id="pajak" class="form-control form-control-sm">
                                <div class="invalid-feedback errorpajak">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nop">N.O.P</label>
                            <div class="col-8">
                                <input type="text" name="nop" id="nop" class="form-control form-control-sm">
                                <div class="invalid-feedback errornop">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nama_wp">Nama WP</label>
                            <div class="col-8">
                                <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm">
                                <div class="invalid-feedback errornama_wp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="alamat_wp">Alamat WP</label>
                            <div class="col-8">
                                <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm">
                                <div class="invalid-feedback erroralamat_wp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="alamat_op">Alamat OP</label>
                            <div class="col-8">
                                <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm">
                                <div class="invalid-feedback erroralamat_op">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="bumi">Bumi</label>
                            <div class="col-8">
                                <input type="number" name="bumi" id="bumi" class="form-control form-control-sm">
                                <div class="invalid-feedback errorbumi">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="bgn">Bgn</label>
                            <div class="col-8">
                                <input type="number" name="bgn" id="bgn" class="form-control form-control-sm">
                                <div class="invalid-feedback errorbgn">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nik_wp">NIK WP</label>
                            <div class="col-8">
                                <input type="number" name="nik_wp" id="nik_wp" class="form-control form-control-sm">
                                <div class="invalid-feedback errornik_wp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nama_ktp">Nama KTP</label>
                            <div class="col-8">
                                <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm">
                                <div class="invalid-feedback errornama_ktp">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_dusun">No. Dusun</label>
                            <div class="col-8">
                                <input type="number" name="no_dusun" id="no_dusun" class="form-control form-control-sm">
                                <div class="invalid-feedback errorno_dusun">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_rw">No. RW</label>
                            <div class="col-8">
                                <input type="number" name="no_rw" id="no_rw" class="form-control form-control-sm">
                                <div class="invalid-feedback errorno_rw">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_rt">No. RT</label>
                            <div class="col-8">
                                <input type="number" name="no_rt" id="no_rt" class="form-control form-control-sm">
                                <div class="invalid-feedback errorno_rt">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="ket">Keterangan</label>
                            <div class="col-8">
                                <input type="text" name="ket" id="ket" class="form-control form-control-sm">
                                <div class="invalid-feedback errorket">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="dhkp_ajuan">List Pengajuan</label>
                            <div class="col-8">
                                <input type="text" name="dhkp_ajuan" id="dhkp_ajuan" class="form-control form-control-sm">
                                <div class="invalid-feedback errordhkp_ajuan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnsimpan">Save</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $('#dd_country').on('change', (event) => {
        // console.log(event.target.value);
        getData(event.target.value).then(data => {
            $('#nop').val(data.nop);
            $('#nama_wp').val(data.nama_wp);
            $('#alamat_wp').val(data.alamat_wp);
            $('#alamat_op').val(data.alamat_op);
            $('#bumi').val(data.bumi);
            $('#bgn').val(data.bgn);
            $('#pajak').val(data.pajak);
            $('#nik_wp').val(data.nik_wp);
            $('#nama_ktp').val(data.nama_ktp);
            $('#pd_desa').val(data.pd_desa);
            $('#no_dusun').val(data.dusun);
            $('#no_rw').val(data.rw);
            $('#no_rt').val(data.rt);
            $('#ket').val(data.sta_keterangan);
            $('#dhkp_ajuan').val(data.pa_keterangan);
        });
    });

    async function getData(id) {
        let response = await fetch('/api/home/' + id)
        let data = await response.json();

        return data;
    }

    $(document).ready(function() {
        // Initialize select2
        $("#dd_country").select2({
            dropdownParent: $('#modalTambah'),
            ajax: {
                url: "<?= site_url('getSppt') ?>",
                type: "post",
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return {
                        query: params.term, // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response.data
                    };
                },
                cache: true
            },
            language: {
                noResults: function(params) {
                    return "Data tidak ditemukan";
                }
            }
        });

        $('.btnsimpan').click(function(e) {
            e.preventDefault();
            let form = $('.formsimpan')[0];
            let data = new FormData(form);

            $.ajax({
                type: "POST",
                url: "<?= site_url('simpandatadhkp') ?>",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.nop) {
                            $('#nop').addClass('is-invalid');
                            $('.errornop').html(response.error.nop);
                        } else {
                            $('#nop').removeClass('is-invalid');
                            $('.errornop').html('');
                        }

                        if (response.error) {
                            $('#nama_wp').addClass('is-invalid');
                            $('.errornama_wp').html(response.error.nama_wp);
                        } else {
                            $('#nama_wp').removeClass('is-invalid');
                            $('.errornama_wp').html('');
                        }

                        if (response.error) {
                            $('#alamat_wp').addClass('is-invalid');
                            $('.erroralamat_wp').html(response.error.alamat_wp);
                        } else {
                            $('#alamat_wp').removeClass('is-invalid');
                            $('.erroralamat_wp').html('');
                        }

                        if (response.error) {
                            $('#alamat_op').addClass('is-invalid');
                            $('.erroralamat_op').html(response.error.alamat_op);
                        } else {
                            $('#alamat_op').removeClass('is-invalid');
                            $('.erroralamat_op').html('');
                        }

                        if (response.error) {
                            $('#bumi').addClass('is-invalid');
                            $('.errorbumi').html(response.error.bumi);
                        } else {
                            $('#bumi').removeClass('is-invalid');
                            $('.errorbumi').html('');
                        }

                        if (response.error) {
                            $('#bgn').addClass('is-invalid');
                            $('.errorbgn').html(response.error.bgn);
                        } else {
                            $('#bgn').removeClass('is-invalid');
                            $('.errorbgn').html('');
                        }

                        if (response.error) {
                            $('#pajak').addClass('is-invalid');
                            $('.errorpajak').html(response.error.pajak);
                        } else {
                            $('#pajak').removeClass('is-invalid');
                            $('.errorpajak').html('');
                        }

                        if (response.error) {
                            $('#nama_ktp').addClass('is-invalid');
                            $('.errornama_ktp').html(response.error.nama_ktp);
                        } else {
                            $('#nama_ktp').removeClass('is-invalid');
                            $('.errornama_ktp').html('');
                        }

                        if (response.error) {
                            $('#pd_desa').addClass('is-invalid');
                            $('.errorpd_desa').html(response.error.pd_desa);
                        } else {
                            $('#pd_desa').removeClass('is-invalid');
                            $('.errorpd_desa').html('');
                        }

                        if (response.error) {
                            $('#no_dusun').addClass('is-invalid');
                            $('.errorno_dusun').html(response.error.no_dusun);
                        } else {
                            $('#no_dusun').removeClass('is-invalid');
                            $('.errorno_dusun').html('');
                        }

                        if (response.error) {
                            $('#no_rw').addClass('is-invalid');
                            $('.errorno_rw').html(response.error.no_rw);
                        } else {
                            $('#no_rw').removeClass('is-invalid');
                            $('.errorno_rw').html('');
                        }

                        if (response.error) {
                            $('#no_rt').addClass('is-invalid');
                            $('.errorno_rt').html(response.error.no_rt);
                        } else {
                            $('#no_rt').removeClass('is-invalid');
                            $('.errorno_rt').html('');
                        }

                        if (response.error) {
                            $('#ket').addClass('is-invalid');
                            $('.errorket').html(response.error.ket);
                        } else {
                            $('#ket').removeClass('is-invalid');
                            $('.errorket').html('');
                        }
                    } else {
                        if (response.sukses) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: response.sukses,

                            });
                            // window.location.reload();
                        }

                        $('#modalTambah').hide();
                        $('.modal-backdrop').hide();
                        table.draw();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>