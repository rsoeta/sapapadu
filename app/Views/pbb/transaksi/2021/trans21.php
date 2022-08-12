<table id="trans21" class="table table-sm table-striped nowrap">
    <thead class="thead-light thead-midle">
        <tr>
            <th>No</th>
            <th>ID Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Penyetor</th>
            <th>Jumlah Setor</th>
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
                echo form_hidden('id_tr', $row['id_tr']);
                ?>
                <td><?= $nomor; ?></td>
                <td><?= $row['tr_faktur']; ?></td>
                <td><?= $row['tr_tgl']; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td style="text-align: right;"><?= number_format($row['tr_totalbersih'], 0, ',', '.'); ?></td>
                <td style="text-align: center;">
                    <a class="btn btn-sm btn-outline-info" href="/pbb/transaction21/detail/<?= $row['id_tr']; ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>

                    <?php if (session()->get('level') == 1) { ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id_tr'] ?>')">
                            <i class="fas fa-trash-alt"></i>
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
        $('#trans21').DataTable();
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
                            trans21();
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