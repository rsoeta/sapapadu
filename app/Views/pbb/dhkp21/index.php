<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

<script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="/pbb/dashboard">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
            <?php
            $user = session()->get('level');
            $jabatan = session()->get('jabatan');
            ?>
            <?= form_open('pbb/dhkp21/ekpor-dhkp21', ['target' => 'blank']); ?>
            <?php if ($user == 1) { ?>
                <div class="row mb-2">
                    <div class="col-6 col-sm-2 col-md-2 float-right">
                        <button type="button" class="btn btn-primary btn-block" onclick="window.location='<?= site_url('pbb/dhkp21/add'); ?>'">
                            <i class="fa fa-plus"> </i> Tambah Data
                        </button>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 float-right">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fa fa-file-excel"></i> Export Data
                        </button>
                    </div>
                </div>
            <?php } ?>
            <div class="row mb-2">
                <div class="col-12 col-sm-12">
                    <div class="row">
                        <div class="col-sm-1 col-4 mb-1" hidden>
                            <label for="data_desa" class="form-label">
                                Desa
                            </label>
                        </div>
                        <div class="col-sm-2 col-8" hidden>
                            <select class="form-control form-control-sm" name="data_desa" id="data_desa">
                                <option value="32.05.33.2006">PASIRLANGU</option>
                            </select>
                        </div>
                        <div class="col-sm-1 col-4 mb-1">
                            <label for="data_dusun" class="form-label">
                                Dusun
                            </label>
                        </div>
                        <div class="col-sm-2 col-8">
                            <select <?php if ($user >= 2) {
                                        echo 'disabled="disabled"';
                                    } ?> class="form-control form-control-sm" name="data_dusun" id="data_dusun">
                                <option value="">-Semua Dusun-</option>
                                <?php foreach ($dusun as $row) { ?>
                                    <option <?php if ($jabatan == $row['no_dusun']) {
                                                echo 'selected';
                                            } ?> value="<?= $row['no_dusun']; ?>"><?= $row['nama_dusun']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-1 col-4 mb-1">
                            <label for="data_rw" class="form-label">
                                RW
                            </label>
                        </div>
                        <div class="col-sm-2 col-8">
                            <select class="form-control form-control-sm" name="data_rw" id="data_rw">
                                <option value="">-Semua RW-</option>
                                <?php foreach ($rw as $row) { ?>
                                    <option value="<?php echo $row['no_rw']; ?>"><?php echo strtoupper($row['no_rw']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-1 col-4 mb-1">
                            <label for="data_rt" class="form-label">
                                RT
                            </label>
                        </div>
                        <div class="col-sm-2 col-8">
                            <select class="form-control form-control-sm" name="data_rt" id="data_rt">
                                <option value="">-Semua RT-</option>
                            </select>
                        </div>
                        <div class="col-sm-1 col-4 mb-1">
                            <label for="keterangan" class="form-label">
                                Keterangan
                            </label>
                        </div>
                        <div class="col-sm-2 col-8">
                            <select class="form-control form-control-sm" name="keterangan" id="keterangan">
                                <option value="">-Pilih-</option>
                                <option value="1">Belum Bayar</option>
                                <option value="0">Lunas</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
            <?= form_close(); ?>
            <div class="row mb-2">
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
                    <div class="col-12">
                        <table id="tb_dhkp21" class="table">
                            <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th>Nama WP</th>
                                    <th>N.O.P</th>
                                    <th>Alamat WP</th>
                                    <th>Alamat OP</th>
                                    <th>Bumi</th>
                                    <th>Bangunan</th>
                                    <th>Pajak</th>
                                    <th>NIK WP</th>
                                    <th>Nama Pemilik</th>
                                    <th>Dusun</th>
                                    <th>RW</th>
                                    <th>RT</th>
                                    <th>dibuat pada</th>
                                    <th>diupdate pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr role="row">
                                    <th colspan="7" style="text-align:center">TOTAL</th>
                                    <th id="total_order"></th>
                                    <th colspan="8"></th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>
<script>
    table = $('#tb_dhkp21').DataTable({
        'order': [],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        'responsive': true,
        'processing': true,
        'serverSide': true,
        "lengthMenu": [
            10, 25, 50, 100, 200, 400, 800, 1600, 3200, 6400, 12800
        ],
        "ajax": {
            "url": "<?= site_url('pbb/tb_dhkp21'); ?>",
            "type": "POST",
            "data": {
                "csrf_test_name": $('input[name=csrf_test_name]').val()
            },
            "data": function(data) {
                data.csrf_test_name = $('input[name=csrf_test_name]').val();
                data.dusun = $('#data_dusun').val();
                data.rw = $('#data_rw').val();
                data.rt = $('#data_rt').val();
                data.keterangan = $('#keterangan').val();
            },
            "dataSrc": function(response) {
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
                return response.data;
            }
        },
        drawCallback: function(settings) {
            $('#total_order').html(settings.json.total);
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }]
    });

    $('#data_dusun').change(function() {
        table.draw();
    });
    $('#data_rw').change(function() {
        table.draw();
    });
    $('#data_rt').change(function() {
        table.draw();
    });
    $('#keterangan').change(function() {
        table.draw();
    });

    $(document).ready(function() {
        $('#tb_dhkp21');
        $('body').addClass('sidebar-collapse');

        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pbb/dhkp21/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#data_dusun').change(function() {
            var desa = $('#data_desa').val();
            var no_dusun = $('#data_dusun').val();
            var action = 'get_rw';
            if (no_dusun != '') {
                $.ajax({
                    url: "<?php echo base_url('action'); ?>",
                    method: "POST",
                    data: {
                        desa: desa,
                        no_dusun: no_dusun,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">-Semua RW-</option>';

                        for (var count = 0; count < data.length; count++) {

                            html += '<option value="' + data[count].no_rw + '">' + data[count].no_rw + '</option>';

                        }

                        $('#data_rw').html(html);
                    }
                });
            } else {
                $('#data_rw').val('');
            }
        });

        $('#data_rw').change(function() {
            var desa = $('#data_desa').val();
            var no_rw = $('#data_rw').val();
            var action = 'get_rt';
            if (no_rw != '') {
                $.ajax({
                    url: "<?php echo base_url('action'); ?>",
                    method: "POST",
                    data: {
                        desa: desa,
                        no_rw: no_rw,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">-Semua RT-</option>';

                        for (var count = 0; count < data.length; count++) {

                            html += '<option value="' + data[count].no_rt + '">' + data[count].no_rt + '</option>';

                        }

                        $('#data_rt').html(html);
                    }
                });
            } else {
                $('#data_rt').val('');
            }
        });
    });

    function edit_person(id) {
        //Ajax Load data from ajax
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('pbb/editPbb21') ?>",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>