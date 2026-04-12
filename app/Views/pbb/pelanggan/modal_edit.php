<style>
    .section {
        margin-bottom: 15px;
    }

    .section-title {
        font-weight: bold;
        font-size: 13px;
        margin-bottom: 6px;
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

    .form-control:focus {
        border: 1px solid #28a745;
        box-shadow: none;
    }

    #modalEditPelanggan .form-control {
        background: #fffdf5;
    }
</style>

<div class="modal fade" id="modalEditPelanggan">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Edit Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- FORM -->
            <form class="formupdate">
                <div class="modal-body">

                    <input type="hidden" name="id_pelanggan" value="<?= $id_pelanggan ?>">

                    <!-- 🔹 SECTION 1 -->
                    <div class="section">
                        <div class="section-title">Identitas</div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" value="<?= $nik ?>" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama_pelanggan" value="<?= $nama_pelanggan ?>" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- 🔹 SECTION 2 -->
                    <div class="section">
                        <div class="section-title">Kontak</div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label>No. WA</label>
                                <input type="text" name="no_hp" value="<?= $no_hp ?>" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat_pelanggan" value="<?= $alamat_pelanggan ?>" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                    <!-- 🔹 SECTION 3 -->
                    <div class="section">
                        <div class="section-title">Wilayah</div>

                        <div class="form-grid-3">
                            <div class="form-group">
                                <label>Dusun</label>
                                <input type="text" name="dusun" value="<?= $dusun ?>" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label>RW</label>
                                <input type="text" name="rw" value="<?= $rw ?>" class="form-control form-control-sm" required>
                            </div>

                            <div class="form-group">
                                <label>RT</label>
                                <input type="text" name="rt" value="<?= $rt ?>" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary tombolUpdate">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    $(document).on('submit', '.formupdate', function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "<?= site_url('pbb/pelanggan/updatedata') ?>",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {

                $('#modalEditPelanggan').modal('hide');

                Swal.fire('Berhasil', response.sukses, 'success');

                pelanggan(); // reload table
            }
        });
    });
</script>