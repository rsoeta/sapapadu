<table id="rekDusun" class="table table-sm table-striped nowrap">
    <thead class="thead-light thead-midle">
        <tr>
            <th>Aksi</th>
            <th>No. Dusun</th>
            <th>Nama Dusun</th>
            <th>Target Setor</th>
            <th>Jumlah Setor</th>
            <th>Sisa Setor</th>
            <th>Persentase</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) : $nomor++;
        ?>
            <tr>
                <?php
                echo form_open('pbb/transaction21/add');
                ?>
                <td style="text-align: center;"><?= $nomor; ?></td>
                <td style="text-align: center;"><?php echo $row['dusun']; ?></td>
                <td><?php echo $row['nama_kadus']; ?></td>
                <td style="text-align: right;"><?php echo number_format($row['pajak1']); ?></td>
                <td style="text-align: right;"><?php echo number_format($row['pajak2']); ?></td>
                <td style="text-align: right;"><?php echo number_format($row['pajak1'] - $row['pajak2']); ?></td>
                <td style="text-align: center;"><?php echo round(($row['pajak2'] / $row['pajak1']) * 100, 2) . "%"; ?></td>
                <td></td>
                <?php echo form_close(); ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#rekDusun').DataTable();
    });

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
                    url: "<?= site_url('pbb/transaction21/hapus') ?>",
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
                            rekDusun();
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