<table id="pelanggan" class="table table-sm table-striped nowrap">
    <thead class="thead-light thead-midle">
        <tr>
            <th>No.</th>
            <th>NIK</th>
            <th>Nama Pelanggan / Wajib Pajak</th>
            <th>No. Dusun</th>
            <th>No. RW</th>
            <th>No. RT</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++;
        ?>
            <tr>
                <?php
                echo form_hidden('id_pelanggan', $row['id_pelanggan']);
                ?>
                <td><?= $nomor; ?></td>
                <td><?= $row['nik']; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['id_dusun']; ?></td>
                <td><?= $row['id_rw']; ?></td>
                <td><?= $row['id_rt']; ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id_pelanggan'] ?>')">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        <!-- Edit -->
                    </button>

                    <?php if (session()->get('level') == 1) { ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_pelanggan'] ?>')">
                            <i class="fas fa-trash"></i>
                            <!-- Hapus -->
                        </button>

                    <?php } ?>
                </td>
                <?php echo form_close(); ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#pelanggan').DataTable();
    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pelanggan/formedit') ?>",
            data: {
                id_pelanggan: id_pelanggan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Anda akan menghapus data tersebut. Yakin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('pbb/pelanggan/hapus') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'sukses',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            dhkp21();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });

            }
        })
    }
</script>