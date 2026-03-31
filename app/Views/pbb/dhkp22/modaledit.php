<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-success">
                <img src="<?= logoApp(); ?>" alt="<?= namaApp(); ?> Logo" class="brand-image" style="width:30px; margin-right: auto">
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
                            <label class="col-4 col-form-label" for="" hidden>ID</label>
                            <div class="col-8">
                                <input type="text" name="id" id="id" class="form-control form-control-sm" value="<?= $id; ?>" hidden>
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
                                <input type="text" name="bumi" id="bumi" class="form-control form-control-sm" value="<?= $bumi; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="bgn">Bgn</label>
                            <div class="col-8">
                                <input type="text" name="bgn" id="bgn" class="form-control form-control-sm" value="<?= $bgn; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="pajak">Pajak</label>
                            <div class="col-8">
                                <input type="text" name="pajak" id="pajak" class="form-control form-control-sm" value="<?= $pajak; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-6 col-md-6">
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nik_wp">NIK WP</label>
                            <div class="col-8">
                                <input type="text" name="nik_wp" id="nik_wp" class="form-control form-control-sm" value="<?= $nik_wp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="nama_ktp">Nama KTP</label>
                            <div class="col-8">
                                <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm" value="<?= $nama_ktp; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_dusun">No. Dusun</label>
                            <div class="col-8">
                                <input type="text" name="no_dusun" id="no_dusun" class="form-control form-control-sm" value="<?= $no_dusun; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_rw">No. RW</label>
                            <div class="col-8">
                                <input type="text" name="no_rw" id="no_rw" class="form-control form-control-sm" value="<?= $no_rw; ?>">
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label" for="no_rt">No. RT</label>
                            <div class="col-8">
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
                    <div class="col-12 mt-3">

                        <!-- PREVIEW GAMBAR LAMA -->
                        <div class="d-flex justify-content-center mb-3">
                            <img id="previewFotoEdit"
                                src="<?= !empty($foto) ? base_url('sppt_img/' . $foto) : '' ?>"
                                style="
                                width: 100%;
                                max-width: 550px;
                                max-height: 60vh;
                                object-fit: contain;
                                border-radius:8px;
                                border:1px solid #ddd;
                                padding:4px;
                                background:#fff;
                                <?= $foto ? '' : 'display:none;' ?>
                                ">
                        </div>

                        <!-- INPUT FILE -->
                        <div class="form-group row nopadding">
                            <label class="col-4 col-form-label">Ganti Foto</label>
                            <div class="col-8">
                                <input type="file" name="foto" id="fotoEdit" class="form-control form-control-sm" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                            </div>
                        </div>

                        <!-- SIMPAN FOTO LAMA -->
                        <input type="hidden" name="foto_lama" value="<?= $foto ?>">

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success tombolSave">Update</button>
                    </div>
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

            let form = $('.formdhkp')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.tombolSave').prop('disable', 'disabled');
                    $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                complete: function() {
                    $('.tombolSave').removeAttr('disabled');
                    $('.tombolsave').html('Update');
                },
                success: function(response) {
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

    $('#fotoEdit').on('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewFotoEdit');

        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });
</script>