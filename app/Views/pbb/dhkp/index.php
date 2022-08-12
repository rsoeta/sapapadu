<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <h5 class="" style="text-decoration: underline;"><strong>DAFTAR HIMPUNAN KETETAPAN PAJAK</strong></h5>
                        </div>
                    </div>
                    <div class="card mt-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-sm btn-primary" onclick="window.location='<?= site_url('dhkp/add'); ?>'">
                                        <i class="fa fa-plus"></i> Add Data
                                    </button>
                                </div>
                                <br>
                                <div class="col">
                                    <form class="form-inline float-right" action="dhkp/index" method="POST">
                                        <?= csrf_field(); ?>
                                        <div class="input-group input-group-sm">
                                            <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="keyword">
                                            <div class="input-group-append">
                                                <button class="btn btn-navbar" type="submit" name="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table id="" class="table table-striped table-hover table-sm mt-2">
                                <thead class="thead-dark thead-midle">
                                    <tr>
                                        <th>#</th>
                                        <th>Aksi</th>
                                        <th>N.O.P</th>
                                        <th>Nama Wajib Pajak</th>
                                        <th>Bumi</th>
                                        <th>Bgn</th>
                                        <th>Pajak</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1 + (($noHalaman - 1) * 10);
                                    foreach ($dhkp as $d) :
                                    ?>
                                        <tr>
                                            <td><?= $nomor++; ?></td>
                                            <td>
                                                <a href="/dhkp/<?= $d['id_sppt']; ?>">
                                                    <i class="fas fa-info-circle fa-lg"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="hapusdhkp('<?= $d['id_sppt'] ?>','<?= $d['nama_wp'] ?>')">
                                                    <i class="fa fa-trash-alt"></i>
                                                </button>
                                            </td>
                                            <td><?= $d['nop']; ?></td>
                                            <td><?= $d['nama_wp']; ?></td>
                                            <td><?= number_format($d['bumi'], 0, ',', '.'); ?></td>
                                            <td><?= $d['bgn']; ?></td>
                                            <td><?= number_format($d['pajak'], 0, ',', '.'); ?></td>
                                            <td><?= $d['ket']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                <?= $pager->links('paging', 'paging_data'); ?>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="viewmodal" style="display: none;"></div>
<script>
    function hapusdhkp(id, nama_wp) {
        Swal.fire({
            title: 'Hapus Data DHKP?',
            html: `Yakin akan menghapus data dhkp <strong>${nama_wp}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Tidak!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('dhkp/hapusdhkp') ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        }
                    }
                });
            }
        })
    }
    $(document).ready(function() {
        $('.tombolAdd').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('dhkp/formtambahdhkp') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahdhkp').on('shown.bs.modal', function(event) {
                            $('#nop').focus();
                        });
                        $('#modaltambahdhkp').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<?= $this->endsection(); ?>