<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper mt-2" style="min-height: 2009.89px;">
    <!-- Main content -->
    <section class="content">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="datadusun">Data Kepala Dusun</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="datarw">Data Ketua RW</a>
            </li>
        </ul>
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col mb-2">
                        <button type="button" class="btn btn-sm btn-primary tombolAdd">
                            <i class="fa fa-plus"></i> Add Data
                        </button>
                    </div>

                    <form action="datart" method="post">
                        <?= csrf_field(); ?>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari RT" name="carirt">
                            <button class="btn btn-sm btn-primary" type="submit" name="tombolrt">Search</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Dusun</th>
                            <th>No RW</th>
                            <th>No RT</th>
                            <th>Nama RT</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor = 1 + (($noHalaman - 1) * 10);
                        foreach ($datart as $d) : ?>
                            <tr>
                                <td><?= $nomor++; ?></td>
                                <td><?= str_pad($d['id_dusun'], 3, 0, STR_PAD_LEFT); ?></td>
                                <td><?= str_pad($d['id_rw'], 3, 0, STR_PAD_LEFT); ?></td>
                                <td><?= str_pad($d['id_rt'], 3, 0, STR_PAD_LEFT); ?></td>
                                <td><?= $d['nama_rt']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusrt('<?= $d['id'] ?>','<?= $d['nama_rt'] ?>')">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-1">
                    <?= $pager->links('paging', 'paging_data'); ?>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>

</section>
<!-- /.content -->

<div class="viewmodal" style="display: none;"></div>
<script>
    function hapusrt(id, nama_rt) {
        Swal.fire({
            title: 'Hapus data RT?',
            html: `Yakin akan menghapus data RT <strong>${nama_rt}</strong>?`,
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
                    url: "<?= site_url('pbb/wilayah/hapusrt') ?>",
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
                url: "<?= site_url('pbb/wilayah/formTambahrt') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahrt').on('shown.bs.modal', function(event) {
                            $('#no_dusun').focus();
                        });
                        $('#modaltambahrt').modal('show');
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