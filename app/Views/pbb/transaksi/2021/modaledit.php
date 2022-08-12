<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaleditLabel">Form Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pbb/dhkp21/updatedata', ['class' => 'formdhkp']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="" hidden>ID</label>
                    <div class="col-sm-8">
                        <input type="text" name="id" id="id" class="form-control form-control-sm" value="<?= $id; ?>" hidden>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">N.O.P</label>
                    <div class="col-sm-8">
                        <input type="text" name="nop" id="nop" class="form-control form-control-sm" value="<?= $nop; ?>" autofocus>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Nama WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm" value="<?= $nama_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Alamat WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm" value="<?= $alamat_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Alamat OP</label>
                    <div class="col-sm-8">
                        <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm" value="<?= $alamat_op; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Bumi</label>
                    <div class="col-sm-8">
                        <input type="text" name="bumi" id="bumi" class="form-control form-control-sm" value="<?= $bumi; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Bgn</label>
                    <div class="col-sm-8">
                        <input type="text" name="bgn" id="bgn" class="form-control form-control-sm" value="<?= $bgn; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Pajak</label>
                    <div class="col-sm-8">
                        <input type="text" name="pajak" id="pajak" class="form-control form-control-sm" value="<?= $pajak; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">NIK WP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nik_wp" id="nik_wp" class="form-control form-control-sm" value="<?= $nik_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Nama KTP</label>
                    <div class="col-sm-8">
                        <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm" value="<?= $nama_ktp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">No. Dusun</label>
                    <div class="col-sm-8">
                        <input type="text" name="dusun" id="dusun" class="form-control form-control-sm" value="<?= $dusun; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">No. RW</label>
                    <div class="col-sm-8">
                        <input type="text" name="rw" id="rw" class="form-control form-control-sm" value="<?= $rw; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">No. RT</label>
                    <div class="col-sm-8">
                        <input type="text" name="rt" id="rt" class="form-control form-control-sm" value="<?= $rt; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-sm-4 col-form-label" for="">Keterangan</label>
                    <div class="col-sm-8">
                        <select name="ket" id="ket" class="form-control form-control-sm" disabled>
                            <option value="0" <?php if ($ket == 'BELUM BAYAR') echo "selected"; ?>>BELUM BAYAR</option>
                            <option value="1" <?php if ($ket == 'LUNAS') echo "selected"; ?>>LUNAS</option>
                        </select>
                        <div class="invalid-feedback errorket">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary tombolSave">Update</button>
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
                        $('.tombolsave').html('Update');
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        })

                        $('#modaledit').modal('hide');
                        dhkp21();
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false;
            });
        });
    </script>