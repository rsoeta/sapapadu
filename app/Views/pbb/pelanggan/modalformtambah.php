<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel">Form Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('pelanggan/simpandata', ['class' => 'formsave']) ?>
            <input type="hidden" name="aksi" id="aksi" value="<?= $aksi; ?>">
            <div class="modal-body">
                <div class="form-group row nopadding">
                    <label for="nama_pelanggan" class="col-4 col-form-label">Nama Pelanggan</label>
                    <div class="col-8">
                        <input type="text" class="form-control form-control-sm" id="nama_pelanggan" name="nama_pelanggan">
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label for="dusun" class="col-4 col-form-label">Dusun</label>
                    <div class="col-8">
                        <select class="form-control form-control-sm" id="dusun" name="dusun"></select>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label for="rw" class="col-4 col-form-label">RW</label>
                    <div class="col-8">
                        <select class="form-control form-control-sm" id="rw" name="rw"></select>
                    </div>
                </div>
                <div class="form-group row nopadding">
                    <label for="rt" class="col-4 col-form-label">RT</label>
                    <div class="col-8">
                        <select class="form-control form-control-sm" id="rt" name="rt"></select>
                    </div>
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

        dataDusun();


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
                            $('#modaltambah').modal('hide');
                            dataPelanggan();
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

    function dataDusun() {

        //pilih data dusun
        $('#dusun').select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: '--Pilih Kadus--',
            ajax: {
                dataType: 'json',
                url: "<?= site_url('dhkp21/ambilDataDusun'); ?>",
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                }
            }
        });

        // pilih data rw
        $('#dusun').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('dhkp21/ambilDataRw'); ?>",
                data: {
                    dusun: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#rw').html(response.data);
                        $('#rw').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        // pilih data rt
        $('#rw').change(function(e) {
            $.ajax({
                type: "post",
                url: "<?= site_url('dhkp21/ambilDataRt'); ?>",
                data: {
                    rw: $(this).val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('#rt').html(response.data);
                        $('#rt').select2();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    }
</script>