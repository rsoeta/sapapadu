<!-- Modal -->
<div class="modal fade" id="modaltambahdusun" tabindex="-1" aria-labelledby="modaltambahdusunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahdusunLabel">Form Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('wilayah/simpandataDusun', ['class' => 'formsave']) ?>
            <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
            <div class="modal-body">
                <div class="form-group">
                    <label for="no_dusun">No. Dusun</label>
                    <input type="number" name="no_dusun" id="no_dusun" class="form-control form-control-sm" required>
                    <label for="nama_dusun">Nama Dusun</label>
                    <input type="text" name="nama_dusun" id="nama_dusun" class="form-control form-control-sm" required>
                    <label for="nama_kadus">Nama Kepala Dusun</label>
                    <input type="text" name="nama_kadus" id="nama_kadus" class="form-control form-control-sm" required>
                    <label for="alamat_kadus">Alamat Kepala Dusun</label>
                    <input type="text" name="alamat_kadus" id="alamat_kadus" class="form-control form-control-sm">
                    <label for="no_hp_kadus">No. HP Kepala Dusun</label>
                    <input type="number" name="no_hp_kadus" id="no_hp_kadus" class="form-control form-control-sm">
                    <label for="no_hp_kadus">No. KTP / NIK Kepala Dusun</label>
                    <input type="number" name="nik_kadus" id="nik_kadus" class="form-control form-control-sm">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary tombolSimpan">Save</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.formsave').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function(e) {
                    $('.tombolSimpan').prop('disabled', true);
                    $('.tombolSimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    let aksi = $('#aksi').val();

                    if (response.success) {
                        if (aksi == 0) {
                            Swal.fire(
                                'Berhasil!',
                                response.success,
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            $('#modaltambahdusun').modal('hide');
                            dataDusun();
                        }


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