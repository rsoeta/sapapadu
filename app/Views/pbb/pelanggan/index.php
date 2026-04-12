<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pbb/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
            <!-- </div> -->
            <!-- </div> -->

            <!-- <div class="content"> -->
            <!-- <div class="container-fluid"> -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" onclick="tambahPelanggan()">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                        <div class="card-body">

                            <?php
                            if (!empty(session()->getFlashdata('success'))) { ?>
                                <div class="alert alert-success">
                                    <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty(session()->getFlashdata('info'))) { ?>
                                <div class="alert alert-info">
                                    <?php echo session()->getFlashdata('info'); ?>
                                </div>
                            <?php } ?>

                            <?php if (!empty(session()->getFlashdata('warning'))) { ?>
                                <div class="alert alert-warning">
                                    <?php echo session()->getFlashdata('warning'); ?>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div style="margin-bottom:10px;">
                                    <input type="text" id="searchPelanggan" class="form-control form-control-sm"
                                        placeholder="Cari nama / NIK...">
                                </div>
                                <div class="table table-hover pelanggan"></div>
                                <!-- <?php if (empty($tampildata)) : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                    </tr> -->
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="viewmodal" style="display: none;"></div>

<script>
    $(document).ready(function() {

        pelanggan();


    });

    // ==========================
    // TAMBAH PELANGGAN
    // ==========================
    function tambahPelanggan() {

        console.log('klik tambah');

        $.ajax({
            url: "<?= site_url('pbb/pelanggan/formmodal'); ?>",
            dataType: "json",
            success: function(response) {

                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalTambahPelanggan').modal('show');
                }

            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }


    // ==========================
    // EDIT PELANGGAN
    // ==========================
    function editPelanggan(id) {

        console.log('klik edit:', id);

        $.ajax({
            type: "post",
            url: "<?= site_url('pbb/pelanggan/formedit') ?>",
            data: {
                id_pelanggan: id
            },
            dataType: "json",
            success: function(response) {

                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalEditPelanggan').modal('show');
                } else {
                    Swal.fire('Error', response.error, 'error');
                }

            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function pelanggan(keyword = '') {
        $.ajax({
            url: "<?= site_url('pbb/pelanggan/ambildata'); ?>",
            type: "post",
            data: {
                search: keyword
            },
            dataType: "json",
            success: function(response) {

                $('.pelanggan').html(response.data);

                // 🔥 INIT DATATABLE DI SINI
                $('#tablePelanggan').DataTable({
                    responsive: true,
                    destroy: true,
                    autoWidth: false,
                    pageLength: 10,

                    // 🔥 INI YANG KITA TAMBAHKAN
                    dom: 'lrtip'
                });

            }
        });
    }

    $('#searchPelanggan').on('keyup', function() {
        let keyword = $(this).val();
        pelanggan(keyword);
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
                            pelanggan();
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
<?= $this->endSection(); ?>