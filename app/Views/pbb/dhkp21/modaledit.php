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
                    <label class="col-4 col-form-label" for="id" hidden>ID</label>
                    <div class="col-8">
                        <input type="number" name="id" id="id" class="form-control form-control-sm" value="<?= $id; ?>" hidden>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="nop">N.O.P</label>
                    <div class="col-8">
                        <input type="text" name="nop" id="nop" class="form-control form-control-sm" value="<?= $nop; ?>" autofocus>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="nama_wp">Nama WP</label>
                    <div class="col-8">
                        <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm" value="<?= $nama_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="alamat_wp">Alamat WP</label>
                    <div class="col-8">
                        <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm" value="<?= $alamat_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="alamat_op">Alamat OP</label>
                    <div class="col-8">
                        <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm" value="<?= $alamat_op; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="bumi">Bumi</label>
                    <div class="col-8">
                        <input type="number" name="bumi" id="bumi" class="form-control form-control-sm" value="<?= $bumi; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="bgn">Bgn</label>
                    <div class="col-8">
                        <input type="number" name="bgn" id="bgn" class="form-control form-control-sm" value="<?= $bgn; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="pajak">Pajak</label>
                    <div class="col-8">
                        <input type="number" name="pajak" id="pajak" class="form-control form-control-sm" value="<?= $pajak; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="nik_wp">NIK WP</label>
                    <div class="col-8">
                        <input type="number" name="nik_wp" id="nik_wp" class="form-control form-control-sm" value="<?= $nik_wp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="nama_ktp">Nama KTP</label>
                    <div class="col-8">
                        <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm" value="<?= $nama_ktp; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="dusun">No. Dusun</label>
                    <div class="col-8">
                        <input type="number" name="dusun" id="dusun" class="form-control form-control-sm" value="<?= $dusun; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="rw">No. RW</label>
                    <div class="col-8">
                        <input type="number" name="rw" id="rw" class="form-control form-control-sm" value="<?= $rw; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="rt">No. RT</label>
                    <div class="col-8">
                        <input type="number" name="rt" id="rt" class="form-control form-control-sm" value="<?= $rt; ?>">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="ket">Keterangan</label>
                    <div class="col-8">
                        <select name="ket" id="ket" class="form-control form-control-sm">
                            <?php foreach ($ket_bayar as $row) { ?>
                                <option value="<?= $row['sta_id']; ?>" <?= ($ket == $row['sta_id'] ? 'selected' : '') ?>><?= $row['sta_keterangan']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errorket">
                        </div>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label class="col-4 col-form-label" for="dhkp_ajuan">List Pengajuan</label>
                    <div class="col-8">
                        <select name="dhkp_ajuan" id="dhkp_ajuan" class="form-control form-control-sm">
                            <option value="">--</option>
                            <?php foreach ($listAjuan as $row) { ?>
                                <option value="<?= $row['pa_id']; ?>" <?= ($dhkp_ajuan == $row['pa_id'] ? 'selected' : '') ?>><?= $row['pa_keterangan']; ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback errordhkp_ajuan">
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
                        table.draw()
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false;
            });
        });
    </script>