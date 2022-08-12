<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambahdhkpLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahdhkpLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pbb/dhkp21/simpandatadhkp', ['class' => 'formdhkp']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label id="nop" class="col-sm-4 col-form-label" for="">N.O.P</label>
                    <div class="col-sm-8">
                        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="text" name="nop" id="nop" class="form-control form-control-sm">
                        <div class="invalid-feedback errorNop">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label id="nama_wp" class="col-sm-4 col-form-label" for="">Nama WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm">
                        <div class="invalid-feedback errornama_wp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label id="alamat_wp" class="col-sm-4 col-form-label" for="">Alamat WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm">
                        <div class="invalid-feedback erroralamat_wp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Alamat OP</label>
                    <div class="col-sm-8">
                        <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm">
                        <div class="invalid-feedback erroralamat_op">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Bumi</label>
                    <div class="col-sm-8">
                        <input type="text" name="bumi" id="bumi" class="form-control form-control-sm">
                        <div class="invalid-feedback errorbumi">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Bgn</label>
                    <div class="col-sm-8">
                        <input type="text" name="bgn" id="bgn" class="form-control form-control-sm">
                        <div class="invalid-feedback errorbgn">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Pajak</label>
                    <div class="col-sm-8">
                        <input type="text" name="pajak" id="pajak" class="form-control form-control-sm">
                        <div class="invalid-feedback errorpajak">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">NIK WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nik_wp" id="nik_wp" class="form-control form-control-sm">
                        <div class="invalid-feedback errornik_wp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Nama KTP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm">
                        <div class="invalid-feedback errornama_ktp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">No. Dusun</label>
                    <div class="col-sm-8">
                        <input type="text" name="dusun" id="dusun" class="form-control form-control-sm">
                        <div class="invalid-feedback errordusun">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">No. RW</label>
                    <div class="col-sm-8">
                        <input type="text" name="rw" id="rw" class="form-control form-control-sm">
                        <div class="invalid-feedback errorrw">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">No. RT</label>
                    <div class="col-sm-8">
                        <input type="text" name="rt" id="rt" class="form-control form-control-sm">
                        <div class="invalid-feedback errorrt">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label" for="">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="ket" id="ket" class="form-control form-control-sm">
                            <option value="0">BELUM BAYAR</option>
                            <option value="1">LUNAS</option>
                        </select>
                        <div class="invalid-feedback errorket">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tombolSave">Save</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.formdhkp').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.tombolSave').prop('disable', 'disabled');
                        $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i>')
                    },
                    complete: function() {
                        $('.tombolsave').removeAttr('disable');
                        $('.tombolsave').html('Simpan');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.nop) {
                                $('#nop').addClass('is-invalid');
                                $('.errorNop').html(response.error.nop);
                            } else {
                                $('#nop').removeClass('is-invalid');
                                $('.errorNop').html('');
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
                                $('#dusun').addClass('is-invalid');
                                $('.errordusun').html(response.error.dusun);
                            } else {
                                $('#dusun').removeClass('is-invalid');
                                $('.errordusun').html('');
                            }

                            if (response.error) {
                                $('#rw').addClass('is-invalid');
                                $('.errorrw').html(response.error.rw);
                            } else {
                                $('#rw').removeClass('is-invalid');
                                $('.errorrw').html('');
                            }

                            if (response.error) {
                                $('#rt').addClass('is-invalid');
                                $('.errorrt').html(response.error.rt);
                            } else {
                                $('#rt').removeClass('is-invalid');
                                $('.errorrt').html('');
                            }

                            if (response.error) {
                                $('#ket').addClass('is-invalid');
                                $('.errorket').html(response.error.ket);
                            } else {
                                $('#ket').removeClass('is-invalid');
                                $('.errorket').html('');
                            }
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses
                            })

                            $('#modaltambah').modal('hide');
                            table.draw()
                        }
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false;
            });
        });
    </script>

    <!-- Script -->
    <script>
        $(document).ready(function() {
            // Initialize
            $("#nop").autocomplete({

                source: function(request, response) {

                    // CSRF Hash
                    var csrfName = $('.txt_csrfname').attr('name'); // CSRF Token name
                    var csrfHash = $('.txt_csrfname').val(); // CSRF hash

                    // Fetch data
                    $.ajax({
                        url: "<?= site_url('pbb/dhkp21/getUsers') ?>",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term,
                            [csrfName]: csrfHash // CSRF Token
                        },
                        success: function(data) {
                            // Update CSRF Token
                            $('.txt_csrfname').val(data.token);

                            response(data.data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#nop').val(ui.item.label); // display the selected text
                    $('#nama_wp').val(ui.item.value); // save selected id to input
                    $('#alamat_wp').val(ui.item.value2); // save selected id to input
                    return false;
                },
                focus: function(event, ui) {
                    $("#nop").val(ui.item.label);
                    $("#nama_wp").val(ui.item.value);
                    $("#alamat_wp").val(ui.item.value2);
                    return false;
                },
            });
        });
    </script>