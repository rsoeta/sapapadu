<table id="pbblunas" class="table table-sm table-hover">
    <thead class="bg-success thead-midle">
        <tr>
            <th>No.</th>
            <th>N.O.P</th>
            <th>Nama Wajib Pajak</th>
            <th>Pajak</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++;
        ?>
            <tr>
                <td><?= $nomor; ?></td>
                <td><?= $row['nop']; ?></td>
                <td><?= $row['nama_wp']; ?></td>
                <td><?= number_format($row['pajak'], 0, ',', '.'); ?></td>
                <td>
                    <?php echo $row['ket'] == 1 ? 'LUNAS' : 'BELUM LUNAS' ?>
                </td>
                <td>
                    <?php
                    echo
                    date($row['tr_tgl']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#pbblunas').DataTable();
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