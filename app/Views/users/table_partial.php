<table class="table table-bordered">
    <thead>
        <tr>
            <th class="sortable" data-sort="u.pu_fullname">
                Nama <span class="sort-icon"></span>
            </th>
            <th class="sortable" data-sort="u.pu_username">
                Username <span class="sort-icon"></span>
            </th>
            <th>Role</th>
            <th>Wilayah</th>
            <th class="sortable" data-sort="u.pu_status">
                Status <span class="sort-icon"></span>
            </th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['pu_fullname'] ?></td>
                <td><?= $u['pu_username'] ?></td>
                <td>
                    <?= $u['pu_role_id'] == 1 ? 'Admin Kecamatan' : ($u['pu_role_id'] == 2 ? 'Kolektor' : 'Kadus') ?>
                </td>
                <td>
                    <?= $u['desa_nama'] ?? '-' ?> /
                    <?= $u['dusun_nama'] ?? '-' ?>
                </td>
                <td>
                    <button class="btn btn-sm toggleStatusBtn <?= $u['pu_status'] ? 'btn-success' : 'btn-secondary' ?>" data-id="<?= $u['pu_id'] ?>">
                        <?= $u['pu_status'] ? 'Aktif' : 'Nonaktif' ?>
                    </button>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm btnEdit" data-id="<?= $u['pu_id'] ?>">Edit</button>
                    <a href="/users/delete/<?= $u['pu_id'] ?>" class="btn btn-danger btn-sm btnDelete">Hapus</a>
                    <button
                        class="btn btn-info btn-sm btnResetPass"
                        data-id="<?= $u['pu_id'] ?>">
                        Reset Password
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php
$totalPages = ceil($total / $limit);
?>

<div class="d-flex justify-content-between align-items-center mt-3">

    <div>
        Menampilkan <?= count($users) ?> dari <?= $total ?> data
    </div>

    <nav>
        <ul class="pagination mb-0">

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a href="#" class="page-link btnPage" data-page="<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

        </ul>
    </nav>

</div>