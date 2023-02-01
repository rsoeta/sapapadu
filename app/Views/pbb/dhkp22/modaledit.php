<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <img src="<?= logoApp(); ?>" alt="<?= namaApp(); ?> Logo" class="brand-image" style="opacity: .8; width:5%; margin-right: auto">
                <h5 class="modal-title" id="modaleditLabel"><b><?= $title; ?></b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('updatedata', ['class' => 'formdhkp']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="" hidden>ID</label>
                            <div class="col-sm-8">
                                <input type="text" name="id" id="id" class="form-control form-control-sm" value="<?= $id; ?>" hidden>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="nop">N.O.P</label>
                            <div class="col-sm-8">
                                <input type="text" name="nop" id="nop" class="form-control form-control-sm" value="<?= $nop; ?>" autofocus>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="nama_wp">Nama WP</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm" value="<?= $nama_wp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="alamat_wp">Alamat WP</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm" value="<?= $alamat_wp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="alamat_op">Alamat OP</label>
                            <div class="col-sm-8">
                                <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm" value="<?= $alamat_op; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="bumi">Bumi</label>
                            <div class="col-sm-8">
                                <input type="text" name="bumi" id="bumi" class="form-control form-control-sm" value="<?= $bumi; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="bgn">Bgn</label>
                            <div class="col-sm-8">
                                <input type="text" name="bgn" id="bgn" class="form-control form-control-sm" value="<?= $bgn; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="pajak">Pajak</label>
                            <div class="col-sm-8">
                                <input type="text" name="pajak" id="pajak" class="form-control form-control-sm" value="<?= $pajak; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="nik_wp">NIK WP</label>
                            <div class="col-sm-8">
                                <input type="text" name="nik_wp" id="nik_wp" class="form-control form-control-sm" value="<?= $nik_wp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="nama_ktp">Nama KTP</label>
                            <div class="col-sm-8">
                                <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm" value="<?= $nama_ktp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="no_dusun">No. Dusun</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_dusun" id="no_dusun" class="form-control form-control-sm" value="<?= $no_dusun; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="no_rw">No. RW</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_rw" id="no_rw" class="form-control form-control-sm" value="<?= $no_rw; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-sm-4 col-form-label" for="no_rt">No. RT</label>
                            <div class="col-sm-8">
                                <input type="text" name="no_rt" id="no_rt" class="form-control form-control-sm" value="<?= $no_rt; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="ket">Keterangan</label>
                            <div class="col-8">
                                <select name="ket" id="ket" class="form-control form-control-sm">
                                    <?php foreach ($ket_bayar as $row) { ?>
                                        <option value="<?= $row['sta_id']; ?>" <?= ($ket == $row['sta_id'] ? 'selected' : '') ?>><?= $row['sta_keterangan'] ?></option>
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
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success tombolSave">Update</button>
                    </div>
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
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Berhasil',
                        //     text: response.sukses
                        // })
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
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

                        jumlahSppt();
                        jumlahTotal();
                        jumlahLunas();
                        jumlahTotalLunas();
                        jumlahBelumLunas();
                        jumlahTotalBelumLunas();
                        jumlahBermasalah();
                        jumlahTotalBermasalah();
                        table.draw();
                        table0.draw();
                        table1.draw();
                        table2.draw();
                        $('#modaledit').modal('hide');
                    },
                    error: function(xhr, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
                return false;
            });
        });
    </script>