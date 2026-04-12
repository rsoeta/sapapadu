<style>
    .section {
        margin-bottom: 15px;
    }

    .section-title {
        font-weight: bold;
        font-size: 13px;
        margin-bottom: 5px;
        border-left: 4px solid #28a745;
        padding-left: 6px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .form-grid-3 {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 12px;
        margin-bottom: 3px;
    }

    .form-group.full {
        grid-column: span 2;
    }

    .form-control:focus {
        border: 1px solid #28a745;
        box-shadow: none;
    }
</style>

<div class="modal fade" id="modalTambahPelanggan">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- FORM -->
            <form class="formsimpan">
                <div class="modal-body">

                    <?= csrf_field(); ?>

                    <!-- 🔹 SECTION 1 -->
                    <div class="section">
                        <div class="section-title">Identitas</div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control form-control-sm" name="nik" id="nik" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control form-control-sm" name="nama_pelanggan" id="nama_pelanggan" required>
                            </div>
                        </div>
                    </div>

                    <!-- 🔹 SECTION 2 -->
                    <div class="section">
                        <div class="section-title">Kontak</div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>No. WA</label>
                                <input type="text" class="form-control form-control-sm" name="no_hp" id="no_hp" required placeholder="08xxxx / 628xxxx">
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control form-control-sm" name="alamat_pelanggan" id="alamat_pelanggan" required>
                            </div>
                        </div>
                    </div>

                    <!-- 🔹 SECTION 3 -->
                    <div class="section">
                        <div class="section-title">Wilayah</div>

                        <div class="form-grid-3">
                            <div class="form-group">
                                <label>Dusun</label>
                                <input type="text" class="form-control form-control-sm" name="dusun" required>
                            </div>

                            <div class="form-group">
                                <label>RW</label>
                                <input type="text" class="form-control form-control-sm" name="rw" required>
                            </div>

                            <div class="form-group">
                                <label>RT</label>
                                <input type="text" class="form-control form-control-sm" name="rt" required>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tombolSave">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $(document).on('submit', '.formsimpan', function(e) {
            e.preventDefault();

            let form = this;
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?= site_url('pbb/pelanggan/simpandata'); ?>",
                data: data,
                dataType: "json",
                processData: false,
                contentType: false,
                cache: false,

                beforeSend: function() {
                    $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i>');
                    $('.tombolSave').prop('disabled', true);
                },

                complete: function() {
                    $('.tombolSave').html('Simpan');
                    $('.tombolSave').prop('disabled', false);
                },

                success: function(response) {

                    // =========================
                    // VALIDASI ERROR
                    // =========================
                    if (response.error) {

                        if (response.error.errorNik) {
                            $('#nik').addClass('is-invalid');
                            $('.errorNik').html(response.error.errorNik).show();
                        } else {
                            $('#nik').removeClass('is-invalid');
                            $('.errorNik').hide();
                        }

                        if (response.error.errorNamapelanggan) {
                            $('#nama_pelanggan').addClass('is-invalid');
                            $('.errorNamapelanggan').html(response.error.errorNamapelanggan).show();
                        } else {
                            $('#nama_pelanggan').removeClass('is-invalid');
                            $('.errorNamapelanggan').hide();
                        }

                        if (response.error.errorDusun) {
                            $('#dusun').addClass('is-invalid');
                            $('.errorDusun').html(response.error.errorDusun).show();
                        } else {
                            $('#dusun').removeClass('is-invalid');
                            $('.errorDusun').hide();
                        }

                        if (response.error.errorRw) {
                            $('#rw').addClass('is-invalid');
                            $('.errorRw').html(response.error.errorRw).show();
                        } else {
                            $('#rw').removeClass('is-invalid');
                            $('.errorRw').hide();
                        }

                        if (response.error.errorRt) {
                            $('#rt').addClass('is-invalid');
                            $('.errorRt').html(response.error.errorRt).show();
                        } else {
                            $('#rt').removeClass('is-invalid');
                            $('.errorRt').hide();
                        }

                    } else {

                        // =========================
                        // SUKSES
                        // =========================
                        $('#modalTambahPelanggan').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pelanggan berhasil ditambahkan'
                        });

                        // 🔥 REFRESH SELECT2
                        $('#pelanggan').val(null).trigger('change');

                        // 🔥 AUTO SELECT DATA BARU (jika dikirim dari backend)
                        if (response.id_pelanggan) {
                            let newOption = new Option(
                                response.nama_pelanggan,
                                response.id_pelanggan,
                                true,
                                true
                            );
                            $('#pelanggan').append(newOption).trigger('change');
                        }

                    }
                },

                error: function(xhr) {
                    alert(xhr.responseText);
                }

            });

        });

    });

    $('#no_hp').on('input', function() {
        let val = $(this).val();

        if (val.startsWith('08')) {
            $(this).removeClass('is-invalid');
        } else if (val.startsWith('628')) {
            $(this).removeClass('is-invalid');
        } else {
            $(this).addClass('is-invalid');
        }
    });
</script>