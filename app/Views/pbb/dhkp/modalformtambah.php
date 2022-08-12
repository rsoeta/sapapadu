<!-- Modal -->
<div class="modal fade" id="modaltambahdhkp" tabindex="-1" aria-labelledby="modaltambahdhkpLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahdhkpLabel">Form Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('dhkp/simpandatadhkp', ['class' => 'formsave']) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">N.O.P</label>
                    <input type="text" name="nop" id="nop" class="form-control form-control-sm" required value="32.07.040.008.">
                    <label for="">Nama WP</label>
                    <input type="text" name="nama_wp" id="nama_wp" class="form-control form-control-sm" required>
                    <label for="">Alamat WP</label>
                    <input type="text" name="alamat_wp" id="alamat_wp" class="form-control form-control-sm" required>
                    <label for="">Alamat OP</label>
                    <input type="text" name="alamat_op" id="alamat_op" class="form-control form-control-sm" required>
                    <label for="">Bumi</label>
                    <input type="text" name="bumi" id="bumi" class="form-control form-control-sm" required>
                    <label for="">Bgn</label>
                    <input type="text" name="bgn" id="bgn" class="form-control form-control-sm" required>
                    <label for="">Pajak</label>
                    <input type="text" name="pajak" id="pajak" class="form-control form-control-sm" required>
                    <label for="">NIK WP</label>
                    <input type="text" name="nik_wp" id="nik_wp" class="form-control form-control-sm" required>
                    <label for="">Nama KTP</label>
                    <input type="text" name="nama_ktp" id="nama_ktp" class="form-control form-control-sm" required>
                    <label for="">No. Dusun</label>
                    <input type="text" name="dusun" id="dusun" class="form-control form-control-sm" required>
                    <label for="">No. RW</label>
                    <input type="text" name="rw" id="rw" class="form-control form-control-sm" required>
                    <label for="">No. RT</label>
                    <input type="text" name="rt" id="rt" class="form-control form-control-sm" required>
                    <label for="">Keterangan</label>
                    <input type="text" name="ket" id="ket" class="form-control form-control-sm" required value="BELUM BAYAR">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary tombolSave">Save</button>
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
                    $('.tombolSave').prop('disabled', true);
                    $('.tombolSave').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Berhasil!',
                            response.success,
                            'success'
                        ).then((result) => {
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
            return false;
        });
    });
</script>