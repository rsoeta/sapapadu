<style>
    /* Styling khusus tabel agar lebih clean */
    .elegant-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        /* Memberi jarak antar baris */
    }

    .elegant-table thead th {
        border: none;
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 15px;
    }

    .elegant-table tbody tr {
        background-color: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .elegant-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
    }

    .elegant-table tbody td {
        border: none;
        padding: 12px 15px;
        vertical-align: middle;
        color: #334155;
        font-weight: 500;
    }

    /* Membulatkan ujung baris */
    .elegant-table tbody td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }

    .elegant-table tbody td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .btn-copy {
        background: #f1f5f9;
        color: #0ea5e9;
        border: none;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 0.8rem;
        transition: all 0.2s;
    }

    .btn-copy:hover {
        background: #e0f2fe;
        color: #0284c7;
    }
</style>

<div class="table-responsive">
    <table id="trans21" class="table elegant-table nowrap">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Penyetor</th>
                <th style="text-align: right;">Jumlah Setor</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 0;
            foreach ($tampildata as $row) : $nomor++; ?>
                <tr>
                    <td><?= $nomor; ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="mr-2 font-weight-bold text-primary"><?= $row['tr_faktur']; ?></span>
                            <button type="button" class="btn-copy" onclick="copyID('<?= $row['tr_faktur']; ?>')" title="Salin ID">
                                <i class="far fa-copy"></i>
                            </button>
                        </div>
                    </td>
                    <td><?= date('d M Y', strtotime($row['tr_tgl'])); ?></td>
                    <td>
                        <div class="font-weight-bold"><?= $row['nama_pelanggan']; ?></div>
                    </td>
                    <td style="text-align: right; font-weight: 700; color: #10b981;">
                        Rp <?= number_format($row['tr_totalbersih'], 0, ',', '.'); ?>
                    </td>
                    <td style="text-align: center;">
                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-sm btn-outline-info rounded-lg" onclick="lihatDetail('<?= $row['id_tr']; ?>')" title="Lihat Detail">
                                <i class="fas fa-info-circle"></i>
                            </button>

                            <?php if (session()->get('level') == 1) { ?>
                                <button type="button" class="btn btn-outline-danger btn-sm rounded-lg ml-1" onclick="hapus('<?= $row['id_tr'] ?>')" title="Hapus Transaksi">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#trans21').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "bLengthChange": false, // Menghilangkan pilihan jumlah row biar lebih rapi
        });
    });

    // Fungsi untuk menyalin ID Transaksi
    function copyID(text) {
        navigator.clipboard.writeText(text).then(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: 'success',
                title: 'ID ' + text + ' berhasil disalin!'
            });
        }).catch(function(err) {
            console.error('Gagal menyalin text: ', err);
        });
    }

    function hapus(id) {
        Swal.fire({
            title: 'Hapus Transaksi?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('trx22/hapus') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            trans21(); // Refresh tabel
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    }

    function lihatDetail(id_tr) {
        $.ajax({
            type: "POST",
            url: "<?= site_url('trx22/detailAjax') ?>",
            data: {
                id_tr: id_tr
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalDetailTransaksi').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>