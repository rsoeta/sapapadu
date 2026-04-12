<div class="table-responsive">
    <table id="tablePelanggan" class="table table-sm table-striped">
        <thead class="thead-light thead-midle">
            <tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama Pelanggan</th>
                <th>No. WhatsApp</th>
                <th>Alamat</th>
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
                    <td><?= $row['no_hp']; ?></td>
                    <td><?= $row['alamat_pelanggan']; ?></td>
                    <td><?= $row['id_dusun']; ?></td>
                    <td><?= $row['id_rw']; ?></td>
                    <td><?= $row['id_rt']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editPelanggan('<?= $row['id_pelanggan'] ?>')">
                            <i class="fa fa-edit"></i>
                        </button>

                        <?php if (session()->get('level') == 1) { ?>
                            <button class="btn btn-sm btn-danger" onclick="hapusPelanggan('<?= $row['id_pelanggan'] ?>')">
                                <i class="fa fa-trash"></i>
                            </button>
                        <?php } ?>
                    </td>
                    <?php echo form_close(); ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>