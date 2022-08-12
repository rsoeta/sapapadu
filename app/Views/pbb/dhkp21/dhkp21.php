<table id="dhkp21" class="table table-sm table-hover table-head-fixed">
    <thead class="thead-light thead-midle">
        <tr>
            <th>No.</th>
            <th>N.O.P</th>
            <th>Nama Wajib Pajak</th>
            <th>Pajak</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++;
        ?>
            <tr>
                <?php
                echo form_open('pbb/transaction21/add');
                echo form_hidden('id', $row['id']);
                echo form_hidden('price', $row['pajak']);
                echo form_hidden('name', $row['nama_wp']);
                ?>
                <td><?= $nomor; ?></td>
                <td><?= substr($row['nop'], 14, 8); ?></td>
                <td><?= $row['nama_wp']; ?></td>
                <td><?= number_format($row['pajak'], 0, ',', '.'); ?></td>
                <td><?= $row['ket'] == 0 ? '<span class="badge badge-pill bg-success">LUNAS</span>' : '<span class="badge badge-pill bg-warning">BELUM LUNAS</span>'; ?></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id'] ?>')">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        <!-- Edit -->
                    </button>

                    <?php if (session()->get('level') == 1) { ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id'] ?>')">
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
        $('#dhkp21').DataTable({
            responsive: true,
        });
    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('pbb/dhkp21/formedit') ?>",
            data: {
                id: id
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
                    url: "<?= site_url('pbb/dhkp21/hapus') ?>",
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