<div class="modal fade" id="modalUser" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" action="/users/store" id="formUser">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah User</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <input type="hidden" name="pu_id" id="pu_id">
                    <input type="hidden" id="formMode" value="create">
                    <input type="text" name="pu_nik" id="pu_nik" class="form-control mb-2" placeholder="NIK" required>
                    <small id="nikFeedback" class="text-danger d-none"></small>

                    <input type="text" name="pu_fullname" id="pu_fullname" class="form-control mb-2" placeholder="Nama" required>
                    <input type="text" name="pu_username" id="pu_username" class="form-control mb-2" placeholder="Username" required>
                    <small id="usernameFeedback" class="text-danger d-none"></small>

                    <input type="email" name="pu_email" id="pu_email" class="form-control mb-2" placeholder="Email" required>
                    <small id="emailFeedback" class="text-danger d-none"></small>

                    <input type="password" name="pu_password" id="pu_password" class="form-control mb-2" placeholder="Password">

                    <!-- ROLE -->
                    <select name="pu_role_id" id="roleSelect" class="form-control mb-2" required>
                        <?php if (session()->get('pu_role_id') == 1): ?>
                            <option value="2">Kolektor</option>
                            <option value="3">Kadus</option>
                        <?php else: ?>
                            <option value="3">Kadus</option>
                        <?php endif ?>
                    </select>

                    <!-- DESA -->
                    <div id="desaWrapper">
                        <select name="pu_kode_desa" id="desaSelect" class="form-control mb-2">
                            <option value="">Pilih Desa</option>
                            <?php foreach ($desa as $d): ?>
                                <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- DUSUN -->
                    <div id="dusunWrapper" style="display:none;">
                        <select name="pu_kode_dusun" id="dusunSelect" class="form-control mb-2">
                            <option value="">Pilih Dusun</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {

        let checkTimer;

        // EMAIL
        $('#pu_email').on('keyup', function() {
            clearTimeout(checkTimer);

            let value = $(this).val();
            let id = $('#pu_id').val();

            checkTimer = setTimeout(() => {
                checkUnique('pu_email', value, id, '#emailFeedback');
            }, 400);
        });

        // USERNAME
        $('#pu_username').on('keyup', function() {
            clearTimeout(checkTimer);

            let value = $(this).val();
            let id = $('#pu_id').val();

            checkTimer = setTimeout(() => {
                checkUnique('pu_username', value, id, '#usernameFeedback');
            }, 400);
        });

        // NIK 🔥
        $('#pu_nik').on('keyup', function() {
            clearTimeout(checkTimer);

            let value = $(this).val();
            let id = $('#pu_id').val();

            checkTimer = setTimeout(() => {
                checkUnique('pu_nik', value, id, '#nikFeedback');
            }, 400);
        });

        $('#pu_nik').on('keyup', function() {

            let nik = $(this).val();

            if (nik.length !== 16) {
                $('#nikFeedback')
                    .text('NIK harus 16 digit')
                    .removeClass('d-none');
            }
        });

        // Toggle Status
        $(document).on('click', '.toggleStatusBtn', function() {

            let btn = $(this);
            let id = btn.data('id');

            Swal.fire({
                title: 'Ubah status user?',
                icon: 'question',
                showCancelButton: true
            }).then((result) => {

                if (result.isConfirmed) {

                    $.post('/users/toggle-status/' + id, function(response) {

                        if (response.sukses) {

                            if (response.new_status == 1) {
                                btn.removeClass('btn-secondary').addClass('btn-success').text('Aktif');
                            } else {
                                btn.removeClass('btn-success').addClass('btn-secondary').text('Nonaktif');
                            }

                            showToastSuccess(response.sukses);

                        } else {
                            showToastError(response.message);
                        }

                    });

                }
            });
        });

        // DELETE USER (confirm + redirect)
        $(document).on('click', '.btnDelete', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            confirmAction('Yakin hapus user?', 'Data akan diarsipkan (soft delete)').then((result) => {
                if (result.isConfirmed) {
                    // Optional: kasih feedback cepat sebelum redirect
                    showToastSuccess('Menghapus user...');
                    setTimeout(() => {
                        window.location.href = url;
                    }, 300);
                }
            });
        });

        // OPEN CREATE
        $('#btnTambahUser').click(function() {
            resetForm();
            $('#formMode').val('create');
            $('#formUser').attr('action', '/users/store');
            $('#modalUser .modal-title').text('Tambah User');
            $('#modalUser').modal('show');
        });

        // OPEN EDIT
        $(document).on('click', '.btnEdit', function() {
            const id = $(this).data('id');

            $.get('/users/get/' + id, function(res) {
                resetForm();

                $('#formMode').val('edit');
                $('#formUser').attr('action', '/users/update/' + id);
                $('#modalUser .modal-title').text('Edit User');

                // PREFILL
                $('#pu_id').val(res.pu_id);
                $('#pu_nik').val(res.pu_nik);
                $('#pu_fullname').val(res.pu_fullname);
                $('#pu_username').val(res.pu_username);
                $('#pu_email').val(res.pu_email);
                $('#pu_password').val('');

                $('#roleSelect').val(res.pu_role_id).trigger('change');

                // Desa
                if (res.pu_kode_desa) {
                    $('#desaSelect').val(res.pu_kode_desa).trigger('change');

                    // Load dusun lalu set selected
                    setTimeout(function() {
                        if (res.pu_kode_dusun) {
                            $('#dusunSelect').val(res.pu_kode_dusun);
                        }
                    }, 300);
                }

                $('#modalUser').modal('show');
            });
        });

        // ROLE CHANGE
        $('#roleSelect').change(function() {
            let role = $(this).val();

            if (role == 3) {
                $('#dusunWrapper').show();
            } else {
                $('#dusunWrapper').hide();
                $('#dusunSelect').html('<option value="">Pilih Dusun</option>');
            }
        });

        // LOAD DUSUN
        $('#desaSelect').change(function() {
            let kode_desa = $(this).val();

            $.get('/api/dusun/' + kode_desa, function(res) {
                let html = '<option value="">Pilih Dusun</option>';
                res.forEach(function(d) {
                    html += `<option value="${d.td_kode_dusun}">${d.td_nama_dusun}</option>`;
                });
                $('#dusunSelect').html(html);
            });
        });

        function resetForm() {
            $('#formUser')[0].reset();
            $('#pu_id').val('');
            $('#dusunWrapper').hide();
            $('#dusunSelect').html('<option value="">Pilih Dusun</option>');
        }

        function checkUnique(field, value, id, feedbackSelector) {

            if (!value) return;

            $.get('/users/check-unique', {
                field: field,
                value: value,
                id: id
            }, function(res) {

                let message = '';

                if (field === 'pu_email') message = 'Email sudah digunakan';
                if (field === 'pu_username') message = 'Username sudah digunakan';
                if (field === 'pu_nik') message = 'NIK sudah digunakan';

                if (res.exists) {
                    $(feedbackSelector)
                        .text(message)
                        .removeClass('d-none');
                } else {
                    $(feedbackSelector)
                        .text('')
                        .addClass('d-none');
                }

            });
        }

        $('#formUser').on('submit', function(e) {

            if (
                !$('#emailFeedback').hasClass('d-none') ||
                !$('#usernameFeedback').hasClass('d-none') ||
                !$('#nikFeedback').hasClass('d-none')
            ) {
                e.preventDefault();
                showToastError('Perbaiki data terlebih dahulu');
            }

        });

    });
</script>