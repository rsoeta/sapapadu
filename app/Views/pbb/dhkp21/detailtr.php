<?php
// echo $faktur;
?>
<table class="table table-sm table-hover nopadding">
    <thead>
        <tr>
            <th>No.</th>
            <th>N.O.P</th>
            <th>Nama WP</th>
            <th>Alamat WP</th>
            <th>Alamat OP</th>
            <th>Pajak</th>
            <th hidden>Nama Pemilik</th>
            <th hidden>Ket</th>
            <th class="no-print">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;
        foreach ($datadetail->getResultArray() as $row) :
        ?>
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $row['nop']; ?></td>
                <td><?= $row['nama_wp']; ?></td>
                <td><?= $row['alamat_wp']; ?></td>
                <td><?= $row['alamat_op']; ?></td>
                <td style="text-align: right;"><?= number_format($row['pajak'], 0, ',', '.'); ?></td>
                <td hidden><?= strtoupper($row['nama_ktp']); ?></td>
                <td hidden><?= $row['ket'] == 1 ? "BELUM BAYAR" : "LUNAS"; ?></td>
                <td class="no-print" style="text-align: center;">
                    <a onclick="hapusitem('<?= $row['id']; ?>','<?= $row['nama_wp']; ?>')">
                        <i class="fa fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function hapusitem(id, nama_wp) {
        Swal.fire({
            title: 'Hapus Data',
            html: `Yakin menghapus data <strong>${nama_wp}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('pbb/transaction21/hapusItem'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses == 'berhasil') {
                            dataDetailTr();
                            kosong();
                        }
                    }
                });
            }
        })
    }
</script>