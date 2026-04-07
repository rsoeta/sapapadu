<?= $this->extend('pbb/templates/index'); ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between mb-3">
                <h4>Manajemen User</h4>
                <button class="btn btn-primary" id="btnTambahUser">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            </div>

            <div class="row mb-3">

                <div class="col-md-2">
                    <select id="limitSelect" class="form-control">
                        <option value="10">10 / halaman</option>
                        <option value="25">25 / halaman</option>
                        <option value="50">50 / halaman</option>
                        <option value="100">100 / halaman</option>
                    </select>
                </div>

                <!-- Search -->
                <div class="col-md-2">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama / username / email">
                </div>

                <!-- Role -->
                <div class="col-md-2">
                    <select id="filterRole" class="form-control">
                        <option value="">Semua Role</option>
                        <option value="1">Admin Kecamatan</option>
                        <option value="2">Kolektor</option>
                        <option value="3">Kadus</option>
                    </select>
                </div>

                <!-- Desa -->
                <div class="col-md-2">
                    <select id="filterDesa" class="form-control">
                        <option value="">Semua Desa</option>
                        <?php foreach ($desa as $d): ?>
                            <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-2">
                    <select id="filterStatus" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <!-- Reset -->
                <div class="col-md-2">
                    <button class="btn btn-secondary w-100" id="btnResetFilter">Reset</button>
                </div>

            </div>

            <div id="userTableWrapper">
                <div class="text-center p-3">
                    <i class="fas fa-spinner fa-spin"></i> Loading data...
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->include('users/form_modal') ?>

<script>
    $(document).ready(function() {
        loadUserTable(1);
    });

    let debounceTimer;
    let currentPage = 1;
    let currentSort = 'u.pu_id';
    let currentOrder = 'DESC';
    let currentLimit = 10;

    function loadUserTable(page = 1) {

        currentPage = page;

        const search = $('#searchInput').val();
        const role = $('#filterRole').val();
        const desa = $('#filterDesa').val();
        const status = $('#filterStatus').val();

        $.get('/users/filter', {
            search,
            role,
            desa,
            status,
            page: currentPage,
            sort: currentSort,
            order: currentOrder,
            limit: currentLimit
        }, function(res) {

            // ✅ inject table
            $('#userTableWrapper').html(res);

            // ✅ update icon setelah render
            updateSortIcons();

        });
    }

    function updateSortIcons() {
        $('.sortable').each(function() {
            const field = $(this).data('sort');
            let icon = '';

            if (field === currentSort) {
                icon = currentOrder === 'ASC' ? '↑' : '↓';
            }

            $(this).find('.sort-icon').text(icon);
        });
    }

    // 🔍 Search (debounce)
    $('#searchInput').on('keyup', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => loadUserTable(1), 400);
    });

    // 🎯 Filter change
    $('#filterRole, #filterDesa, #filterStatus').on('change', function() {
        loadUserTable(1);
    });

    // 🔄 Reset
    $('#btnResetFilter').click(function() {
        $('#searchInput').val('');
        $('#filterRole').val('');
        $('#filterDesa').val('');
        $('#filterStatus').val('');
        loadUserTable(1);
    });

    // 📄 Pagination
    $(document).on('click', '.btnPage', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        loadUserTable(page);
    });

    // 🔽 Sorting
    $(document).on('click', '.sortable', function() {

        const sortField = $(this).data('sort');

        if (currentSort === sortField) {
            currentOrder = (currentOrder === 'ASC') ? 'DESC' : 'ASC';
        } else {
            currentSort = sortField;
            currentOrder = 'ASC';
        }

        loadUserTable(1);
    });

    // 📊 Limit selector
    $('#limitSelect').change(function() {
        currentLimit = $(this).val();
        loadUserTable(1);
    });

    $(document).on('click', '.btnResetPass', function() {

        let id = $(this).data('id');

        confirmAction('Reset password user?', 'Password akan diubah ke default (123456)')
            .then((result) => {

                if (result.isConfirmed) {

                    ajaxPost('/users/reset-password/' + id, {}, function(res) {
                        // optional tambahan logika
                    });

                }

            });

    });
</script>
<?= $this->endSection() ?>