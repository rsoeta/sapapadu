<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="modaltambahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahLabel"><?= $title; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo form_open('tambahMenu', ['class' => 'formsimpan']); ?>
                <?= csrf_field(); ?>
                <div class="form-group row nopadding" hidden>
                    <label class="col-4 col-sm-4 col-form-label" for="tm_id">ID</label>
                    <div class="col-8 col-sm-8">
                        <input type="text" name="tm_id" id="tm_id" class="form-control form-control-sm" value="">
                        <div class="invalid-feedback errortm_id"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="container-fluid">
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_sort">No. Urut</label>
                            <div class="col-8 col-sm-8">
                                <input type="text" name="tm_sort" id="tm_sort" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_sort"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_nama">Nama Menu</label>
                            <div class="col-8 col-sm-8">
                                <input type="text" name="tm_nama" id="tm_nama" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_nama"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_class">Class</label>
                            <div class="col-8 col-sm-8">
                                <input type="text" name="tm_class" id="tm_class" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_class"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_url">URL</label>
                            <div class="col-8 col-sm-8">
                                <input type="text" name="tm_url" id="tm_url" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_url"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_icon">Icon</label>
                            <div class="col-8 col-sm-8">
                                <input type="text" name="tm_icon" id="tm_icon" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_icon"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_parent_id">Parent ID</label>
                            <div class="col-8 col-sm-8">
                                <input type="number" name="tm_parent_id" id="tm_parent_id" class="form-control form-control-sm" value="">
                                <div class="invalid-feedback errortm_parent_id"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_grup_akses">Grup Akses</label>
                            <div class="col-8 col-sm-8">
                                <select id="tm_grup_akses" name="tm_grup_akses" class="form-select form-select-sm">
                                    <option value="">-- Pilih Grup --</option>
                                    <?php foreach ($userRole as $role) { ?>
                                        <option value="<?= $role['id_role']; ?>"><?= $role['nm_role']; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback errortm_grup_akses"></div>
                            </div>
                        </div>
                        <div class="form-group row nopadding">
                            <label class="col-4 col-sm-4 col-form-label" for="tm_status">Status</label>
                            <div class="col-8 col-sm-8">
                                <select id="tm_status" name="tm_status" class="form-select form-select-sm">
                                    <option value="0">Nonaktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                                <div class="invalid-feedback errortm_status"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3 justify-content-between">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"> Close</button>
                        <button type="submit" class="btn btn-sm btn-primary float-end btnSimpan"> Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnSimpan').prop('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>')
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.tm_nama) {
                            $('#tm_nama').addClass('is-invalid');
                            $('.errortm_nama').html(response.error.tm_nama);
                        } else {
                            $('#tm_nama').removeClass('is-invalid');
                            $('.errortm_nama').html('');
                        }

                        if (response.error.tm_url) {
                            $('#tm_url').addClass('is-invalid');
                            $('.errortm_url').html(response.error.tm_url);
                        } else {
                            $('#tm_url').removeClass('is-invalid');
                            $('.errortm_url').html('');
                        }

                        if (response.error.tm_icon) {
                            $('#tm_icon').addClass('is-invalid');
                            $('.errortm_icon').html(response.error.tm_icon);
                        } else {
                            $('#tm_icon').removeClass('is-invalid');
                            $('.errortm_icon').html('');
                        }

                        if (response.error.tm_parent_id) {
                            $('#tm_parent_id').addClass('is-invalid');
                            $('.errortm_parent_id').html(response.error.tm_parent_id);
                        } else {
                            $('#tm_parent_id').removeClass('is-invalid');
                            $('.errortm_parent_id').html('');
                        }

                        if (response.error.tm_grup_akses) {
                            $('#tm_grup_akses').addClass('is-invalid');
                            $('.errortm_grup_akses').html(response.error.tm_grup_akses);
                        } else {
                            $('#tm_grup_akses').removeClass('is-invalid');
                            $('.errortm_grup_akses').html('');
                        }

                        if (response.error.tm_status) {
                            $('#tm_status').addClass('is-invalid');
                            $('.errortm_status').html(response.error.tm_status);
                        } else {
                            $('#tm_status').removeClass('is-invalid');
                            $('.errortm_status').html('');
                        }

                    } else {
                        if (response.sukses) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses!',
                                text: response.sukses
                            })

                            $('#modaltambah').modal('hide');
                            location.reload();
                        }
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
        $('#rw').change(function() {
            var desa = $('#datadesa').val();
            var no_rw = $('#rw').val();
            var action = 'get_rt';
            if (no_rw != '') {
                $.ajax({
                    url: "<?php echo base_url('action'); ?>",
                    method: "POST",
                    data: {
                        desa: desa,
                        no_rw: no_rw,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">-Pilih-</option>';
                        for (var count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].no_rt + '">' + data[count].no_rt + '</option>';
                        }
                        $('#rt').html(html);
                    }
                });
            } else {
                $('#rt').val('');
            }
        });
    });
</script>