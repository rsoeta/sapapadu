<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>


<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">


<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url(); ?>/assets/dataTables/DataTables-1.10.24/js/jquery.dataTables.min.js"></script> -->

<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> -->

<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap5.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/jszip/jszip.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/pdfmake/vfs_fonts.js"></script> -->

<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script> -->

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script> -->

<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->

<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->


<script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">FILTER</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="refresh" id="reload_page">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12 col-sm-12">
                                <div class="row mt-2">
                                    <div class="col-4 callout callout-danger">
                                        <div class="form-group row nopadding">
                                            <label for="data_desa" class="col-sm-2 col-form-label">Desa</label>
                                            <div class="col-sm-10">
                                                <select <?= ($pu_role_id >= 2) ? 'disabled="disabled"' : ''; ?> class="form-control form-control-sm" name="data_desa" id="data_desa">
                                                    <option value="">-Semua Desa-</option>
                                                    <?php foreach ($data_desa as $d) : ?>
                                                        <option <?= ($pu_kode_desa == $d['id']) ? 'selected' : ''; ?> value="<?= $d['id']; ?>"><?= $d['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row nopadding">
                                            <label for="data_dusun" class="col-sm-2 col-form-label">Dusun</label>
                                            <div class="col-sm-10">
                                                <select <?= ($pu_role_id >= 3) ? 'disabled="disabled"' : ''; ?> class="form-control form-control-sm" name="data_dusun" id="data_dusun">
                                                    <option value="">-Semua Dusun-</option>
                                                    <?php foreach ($dusun as $row) { ?>
                                                        <option <?= ($pu_level == $row['td_kode_dusun']) ? 'selected' : ''; ?> value="<?= $row['td_kode_dusun']; ?>"><?= $row['td_nama_dusun']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 callout callout-info">
                                        <div class="form-group row nopadding">
                                            <label for="data_rw" class="col-sm-2 col-form-label">No. RW</label>
                                            <div class="col-sm-10">
                                                <select class="form-control form-control-sm" name="data_rw" id="data_rw">
                                                    <option value="">-Semua RW-</option>
                                                    <?php foreach ($rw as $row) { ?>
                                                        <option value="<?= $row['no_rw'] ?>"><?= $row['no_rw'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row nopadding">
                                            <label for="data_rt" class="col-sm-2 col-form-label">No. RT</label>
                                            <div class="col-sm-10">
                                                <select class="form-control form-control-sm" name="data_rt" id="data_rt">
                                                    <option value="">-Semua RT-</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 callout callout-warning">
                                        <div class="form-group row nopadding">
                                            <label for="data_ket" class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" name="data_ket" id="data_ket">
                                                    <option value="">-Semua Keterangan-</option>
                                                    <option value="1">Belum Bayar</option>
                                                    <option value="0">Lunas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row nopadding">
                                            <label for="data_tahun" class="col-sm-3 col-form-label">Tahun</label>
                                            <div class="col-sm-9">
                                                <select class="form-control form-control-sm" name="data_tahun" id="data_tahun">
                                                    <?php foreach (dataTahun() as $row) { ?>
                                                        <option <?= (date('Y') == $row) ? 'selected' : ''; ?> value="<?= $row ?>"><?= $row ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Rekap PBB 2022</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h5>DATA</h5>
                                            <h4><?= number_format($jumlahSppt); ?> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Rp. <?= number_format($jumlahTotal); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h5>LUNAS</h5>
                                            <h4><?= number_format($jumlahLunas); ?> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Rp. <?= number_format($jumlahTotalLunas); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h5>BELUM LUNAS</h5>
                                            <h4><?= number_format($jumlahBelumLunas); ?> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-handshake-slash"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Rp. <?= number_format($jumlahTotalBelumLunas); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h5>BERMASALAH</h5>
                                            <h4><?= number_format($jumlahBermasalah); ?> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header">Rp. <?= number_format($jumlahTotalBermasalah); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="card-title nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="dataPbb-tab" data-bs-toggle="tab" data-bs-target="#dataPbb" type="button" role="tab" aria-controls="dataPbb" aria-selected="true">DATA</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="lunas-tab" data-bs-toggle="tab" data-bs-target="#lunas" type="button" role="tab" aria-controls="lunas" aria-selected="false">LUNAS</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="belumLunas-tab" data-bs-toggle="tab" data-bs-target="#belumLunas" type="button" role="tab" aria-controls="belumLunas" aria-selected="false">BELUM LUNAS</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bermasalah-tab" data-bs-toggle="tab" data-bs-target="#bermasalah" type="button" role="tab" aria-controls="bermasalah" aria-selected="false">BERMASALAH</button>
                                </li>
                            </ul>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="dataPbb" role="tabpanel" aria-labelledby="dataPbb-tab">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button style="float: right;" type="button" class="btn btn-primary rounded shadow tombolTambah">
                                                <i class="fa fa-plus mr-1"></i> Tambah Data
                                            </button>
                                        </div>
                                    </div>
                                    <?php if (!empty(session()->getFlashdata('success'))) { ?>
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
                                    <div class="table-responsive">
                                        <table id="tb_dhkp22" class="table table-sm table-striped table-bordered nowrap compact" cellspacing="0%">
                                            <thead style="background-color: cyan; color: dark;">
                                                <tr role="row">
                                                    <th>No</th>
                                                    <th>Nama WP</th>
                                                    <th>N.O.P</th>
                                                    <th>Alamat WP</th>
                                                    <th>Alamat OP</th>
                                                    <th>Bumi</th>
                                                    <th>Pajak (Rp.)</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Dusun</th>
                                                    <th>RW</th>
                                                    <th>RT</th>
                                                    <th>Ket</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="6" style="text-align:center; text-decoration: black;">TOTAL</th>
                                                    <th id="total_order"></th>
                                                    <th colspan="5"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <div class="tab-pane fade" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button style="float: right;" type="button" class="btn btn-success shadow" onclick="window.location='<?= site_url('trx22'); ?>'">
                                                <i class="fa fa-plus mr-1"></i> Tambah Transaksi
                                            </button>
                                        </div>
                                        <div class="col-12 col-sm-12">
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
                                                <div class="table-responsive">
                                                    <table id="tb_dhkp22_0" class="table nowrap compact" style="width: 100%;">
                                                        <thead style="background-color: green; color: whitesmoke;">
                                                            <tr role="row">
                                                                <th>No</th>
                                                                <th>Nama WP</th>
                                                                <th>N.O.P</th>
                                                                <th>Alamat WP</th>
                                                                <th>Alamat OP</th>
                                                                <th>Bumi</th>
                                                                <th>Pajak (Rp.)</th>
                                                                <th>Tgl Pelunasan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                        <tfoot>
                                                            <tr role="row">
                                                                <th>-</th>
                                                                <th style="text-align:center; text-decoration: black;">JUMLAH TOTAL</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th id="total_order0"></th>
                                                                <th>-</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="belumLunas" role="tabpanel" aria-labelledby="belumLunas-tab">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button style="float: right;" type="button" class="btn btn-success shadow" onclick="window.location='<?= site_url('trx22'); ?>'">
                                                <i class="fa fa-plus mr-1"></i> Tambah Transaksi
                                            </button>
                                            <a type="button" class="btn btn-success shadow">
                                                <i class="fa-regular fa-file-excel mr-1"></i> Export Data
                                            </a>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <div class="row mt-2">
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
                                                <div class="table-responsive">
                                                    <table id="tb_dhkp22_1" class="table nowrap compact" style="width: 100%;">
                                                        <thead style="background-color: red; color: floralwhite;">
                                                            <tr role="row">
                                                                <th>No</th>
                                                                <th>Nama WP</th>
                                                                <th>N.O.P</th>
                                                                <th>Alamat WP</th>
                                                                <th>Alamat OP</th>
                                                                <th>Bumi</th>
                                                                <th>Pajak (Rp.)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                        <tfoot>
                                                            <tr role="row">
                                                                <th>-</th>
                                                                <th style="text-align:center; text-decoration: black;">JUMLAH TOTAL</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th>-</th>
                                                                <th id="total_order1"></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="bermasalah" role="tabpanel" aria-labelledby="bermasalah-tab">
                                    <div class="col-12 col-sm-12">
                                        <div class="row mt-2">
                                            <?php if (!empty(session()->getFlashdata('success'))) { ?>
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
                                            <div class="table-responsive">
                                                <table id="tb_dhkp22_2" class="table nowrap compact" style="width: 100%;">
                                                    <thead style="background-color: yellow; color: black;">
                                                        <tr role="row">
                                                            <th>No</th>
                                                            <th>Nama WP</th>
                                                            <th>N.O.P</th>
                                                            <th>Alamat WP</th>
                                                            <th>Alamat OP</th>
                                                            <th>Bumi</th>
                                                            <th>Pajak (Rp.)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr role="row">
                                                            <th>-</th>
                                                            <th style="text-align:center; text-decoration: black;">JUMLAH TOTAL</th>
                                                            <th>-</th>
                                                            <th>-</th>
                                                            <th>-</th>
                                                            <th>-</th>
                                                            <th id="total_order2"></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    var table;
    var table0;
    var table1;
    var table2;
    moment.locale("id");

    table = $('#tb_dhkp22').DataTable({
        'order': [],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        'responsive': true,
        'processing': true,
        'serverSide': true,
        "lengthMenu": [
            10, 25, 50, 100, 200, 400, 800, 1600, 3200
        ],
        "pageLength": 10,

        "ajax": {
            "url": "<?= site_url('tb_dhkp22'); ?>",
            "type": "POST",
            "data": {
                "csrf_test_name": $('input[name=csrf_test_name]').val()
            },

            "data": function(data) {
                data.csrf_test_name = $('input[name=csrf_test_name]').val();
                data.data_desa = $('#data_desa').val();
                data.data_dusun = $('#data_dusun').val();
                data.data_rw = $('#data_rw').val();
                data.data_rt = $('#data_rt').val();
                data.data_ket = $('#data_ket').val();
                data.data_tahun = $('#data_tahun').val();
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
        }],
        "columnDefs": [{
            "targets": [8, 9, 10],
            "visible": false
        }],
        dom: 'lBfrtip',
        buttons: [
            //'pageLength',
            <?php if (session()->get('level') == 1) { ?> {
                    title: 'LAMPIRAN DATA PBB 2022',
                    extend: 'excelHtml5',
                    footer: true,
                    messageTop: function() {
                        dataDesa = $('#data_desa').val();
                        dataDusun = $('#data_dusun').val();
                        dataRw = $('#data_rw').val();
                        dataRt = $('#data_rt').val();
                        dataKet = $('#data_ket').val();
                        // set a variable
                        var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                        if (dataRw === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                },
            <?php } ?> {
                title: 'LAMPIRAN DATA PBB 2022',
                extend: 'pdfHtml5',
                footer: true,
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
            },
            {
                title: 'LAMPIRAN DATA PBB 2022',
                extend: 'print',
                footer: true,
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
            },
        ],
    });

    table0 = $('#tb_dhkp22_0').DataTable({
        'order': [],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        'responsive': true,
        'width': 100,
        'processing': true,
        'serverSide': true,
        "lengthMenu": [
            10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250, 260, 270, 280, 290, 300, 310, 320, 330, 340, 350, 360, 370, 380, 390, 400, 410, 420, 430, 440, 450, 460, 470, 480, 490, 500, 510, 520, 530, 540, 550, 560, 570, 580, 590, 600, 610, 620, 630, 640, 650, 660, 670, 680, 690, 700, 710, 720, 730, 740, 750, 760, 770, 780, 790, 800, 810, 820, 830, 840, 850, 860, 870, 880, 890, 900, 910, 920, 930, 940, 950, 960, 970, 980, 990, 1000, 1010, 1020, 1030, 1040, 1050, 1060, 1070, 1080, 1090, 1100, 1110, 1120, 1130, 1140, 1150, 1160, 1170, 1180, 1190, 1200, 1210, 1220, 1230, 1240, 1250, 1260, 1270, 1280, 1290, 1300, 1310, 1320, 1330, 1340, 1350, 1360, 1370, 1380, 1390, 1400, 1410, 1420, 1430, 1440, 1450, 1460, 1470, 1480, 1490, 1500, 1510, 1520, 1530, 1540, 1550, 1560, 1570, 1580, 1590, 1600, 1610, 1620, 1630, 1640, 1650, 1660, 1670, 1680, 1690, 1700, 1710, 1720, 1730, 1740, 1750, 1760, 1770, 1780, 1790, 1800, 1810, 1820, 1830, 1840, 1850, 1860, 1870, 1880, 1890, 1900, 1910, 1920, 1930, 1940, 1950, 1960, 1970, 1980, 1990, 2000, 2010, 2020, 2030, 2040, 2050, 2060, 2070, 2080, 2090, 2100, 2110, 2120, 2130, 2140, 2150, 2160, 2170, 2180, 2190, 2200, 2210, 2220, 2230, 2240, 2250, 2260, 2270, 2280, 2290, 2300, 2310, 2320, 2330, 2340, 2350, 2360, 2370, 2380, 2390, 2400, 2410, 2420, 2430, 2440, 2450, 2460, 2470, 2480, 2490, 2500, 2510, 2520, 2530, 2540, 2550, 2560, 2570, 2580, 2590, 2600, 2610, 2620, 2630, 2640, 2650, 2660, 2670, 2680, 2690, 2700, 2710, 2720, 2730, 2740, 2750, 2760, 2770, 2780, 2790, 2800, 2810, 2820, 2830, 2840, 2850, 2860, 2870, 2880, 2890, 2900, 2910, 2920, 2930, 2940, 2950, 2960, 2970, 2980, 2990, 3000, 3010, 3020, 3030, 3040, 3050, 3060, 3070, 3080, 3090, 3100, 3110, 3120, 3130, 3140, 3150, 3160, 3170, 3180, 3190, 3200, 3210, 3220, 3230, 3240, 3250, 3260, 3270, 3280, 3290, 3300, 3310, 3320, 3330, 3340, 3350, 3360, 3370, 3380, 3390, 3400, 3410, 3420, 3430, 3440, 3450, 3460, 3470, 3480, 3490, 3500, 3510, 3520, 3530, 3540, 3550, 3560, 3570, 3580, 3590, 3600, 3610, 3620, 3630, 3640, 3650, 3660, 3670, 3680, 3690, 3700, 3710, 3720, 3730, 3740, 3750, 3760, 3770, 3780, 3790, 3800, 3810, 3820, 3830, 3840, 3850, 3860, 3870, 3880, 3890, 3900, 3910, 3920, 3930, 3940, 3950, 3960, 3970, 3980, 3990, 4000,
        ],
        "pageLength": 10,
        "ajax": {
            "url": "<?= site_url('tb_dhkp22_lunas'); ?>",
            "type": "POST",
            "data": {
                "csrf_test_name": $('input[name=csrf_test_name]').val()
            },

            "data": function(data) {
                data.csrf_test_name = $('input[name=csrf_test_name]').val();
                data.data_desa = $('#data_desa').val();
                data.data_dusun = $('#data_dusun').val();
                data.data_rw = $('#data_rw').val();
                data.data_rt = $('#data_rt').val();
                data.data_ket = $('#data_ket').val();
                data.data_tahun = $('#data_tahun').val();
            },
            "dataSrc": function(response) {
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
                return response.data;
            }
        },
        drawCallback: function(settings) {
            $('#total_order0').html(settings.json.total);
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        dom: 'lBfrtip',
        buttons: [
            //'pageLength',
            <?php if (session()->get('level') == 1) { ?> {
                    title: 'LAMPIRAN DATA PBB LUNAS 2022',
                    extend: 'excelHtml5',
                    footer: true,
                    messageTop: function() {
                        dataDesa = $('#data_desa').val();
                        dataDusun = $('#data_dusun').val();
                        dataRw = $('#data_rw').val();
                        dataRt = $('#data_rt').val();
                        dataKet = $('#data_ket').val();
                        dataTahun = $('#data_tahun').val();
                        // set a variable
                        var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                        if (dataRw === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                },
            <?php } ?> {
                title: 'LAMPIRAN DATA PBB LUNAS 2022',
                extend: 'pdfHtml5',
                footer: true,
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
            },
            {
                title: 'LAMPIRAN DATA PBB LUNAS 2022',
                extend: 'print',
                footer: true,
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
            },
        ],

    });

    // TABEL BELUM LUNAS
    table1 = $('#tb_dhkp22_1').DataTable({
        'order': [],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        "lengthChange": true,
        'responsive': true,
        'width': 100,
        'processing': true,
        'serverSide': true,
        "lengthMenu": [
            10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180, 190, 200, 210, 220, 230, 240, 250, 260, 270, 280, 290, 300, 310, 320, 330, 340, 350, 360, 370, 380, 390, 400, 410, 420, 430, 440, 450, 460, 470, 480, 490, 500, 510, 520, 530, 540, 550, 560, 570, 580, 590, 600, 610, 620, 630, 640, 650, 660, 670, 680, 690, 700, 710, 720, 730, 740, 750, 760, 770, 780, 790, 800, 810, 820, 830, 840, 850, 860, 870, 880, 890, 900, 910, 920, 930, 940, 950, 960, 970, 980, 990, 1000, 1010, 1020, 1030, 1040, 1050, 1060, 1070, 1080, 1090, 1100, 1110, 1120, 1130, 1140, 1150, 1160, 1170, 1180, 1190, 1200, 1210, 1220, 1230, 1240, 1250, 1260, 1270, 1280, 1290, 1300, 1310, 1320, 1330, 1340, 1350, 1360, 1370, 1380, 1390, 1400, 1410, 1420, 1430, 1440, 1450, 1460, 1470, 1480, 1490, 1500, 1510, 1520, 1530, 1540, 1550, 1560, 1570, 1580, 1590, 1600, 1610, 1620, 1630, 1640, 1650, 1660, 1670, 1680, 1690, 1700, 1710, 1720, 1730, 1740, 1750, 1760, 1770, 1780, 1790, 1800, 1810, 1820, 1830, 1840, 1850, 1860, 1870, 1880, 1890, 1900, 1910, 1920, 1930, 1940, 1950, 1960, 1970, 1980, 1990, 2000, 2010, 2020, 2030, 2040, 2050, 2060, 2070, 2080, 2090, 2100, 2110, 2120, 2130, 2140, 2150, 2160, 2170, 2180, 2190, 2200, 2210, 2220, 2230, 2240, 2250, 2260, 2270, 2280, 2290, 2300, 2310, 2320, 2330, 2340, 2350, 2360, 2370, 2380, 2390, 2400, 2410, 2420, 2430, 2440, 2450, 2460, 2470, 2480, 2490, 2500, 2510, 2520, 2530, 2540, 2550, 2560, 2570, 2580, 2590, 2600, 2610, 2620, 2630, 2640, 2650, 2660, 2670, 2680, 2690, 2700, 2710, 2720, 2730, 2740, 2750, 2760, 2770, 2780, 2790, 2800, 2810, 2820, 2830, 2840, 2850, 2860, 2870, 2880, 2890, 2900, 2910, 2920, 2930, 2940, 2950, 2960, 2970, 2980, 2990, 3000, 3010, 3020, 3030, 3040, 3050, 3060, 3070, 3080, 3090, 3100, 3110, 3120, 3130, 3140, 3150, 3160, 3170, 3180, 3190, 3200, 3210, 3220, 3230, 3240, 3250, 3260, 3270, 3280, 3290, 3300, 3310, 3320, 3330, 3340, 3350, 3360, 3370, 3380, 3390, 3400, 3410, 3420, 3430, 3440, 3450, 3460, 3470, 3480, 3490, 3500, 3510, 3520, 3530, 3540, 3550, 3560, 3570, 3580, 3590, 3600, 3610, 3620, 3630, 3640, 3650, 3660, 3670, 3680, 3690, 3700, 3710, 3720, 3730, 3740, 3750, 3760, 3770, 3780, 3790, 3800, 3810, 3820, 3830, 3840, 3850, 3860, 3870, 3880, 3890, 3900, 3910, 3920, 3930, 3940, 3950, 3960, 3970, 3980, 3990, 4000,
        ],
        "pageLength": 10,
        // "lengthMenu": [
        //     10, 25, 50, 100, 200, 400, 800, 1600, 3200
        // ],
        "ajax": {
            "url": "<?= site_url('tb_dhkp22_1'); ?>",
            "type": "POST",
            "data": {
                "csrf_test_name": $('input[name=csrf_test_name]').val()
            },

            "data": function(data) {
                data.csrf_test_name = $('input[name=csrf_test_name]').val();
                data.data_desa = $('#data_desa').val();
                data.data_dusun = $('#data_dusun').val();
                data.data_rw = $('#data_rw').val();
                data.data_rt = $('#data_rt').val();
                data.data_ket = $('#data_ket').val();
                data.data_tahun = $('#data_tahun').val();

            },
            "dataSrc": function(response) {
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
                return response.data;
            }
        },
        drawCallback: function(settings) {
            $('#total_order1').html(settings.json.total);
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        dom: 'lBfrtip',
        buttons: [
            //'pageLength',
            // 'excel', 'pdf', 'print',
            <?php if (session()->get('level') == 1) { ?> {
                    title: 'LAMPIRAN DATA PBB BELUM LUNAS 2022',
                    extend: 'excelHtml5',
                    messageTop: function() {
                        dataDesa = $('#data_desa').val();
                        dataDusun = $('#data_dusun').val();
                        dataRw = $('#data_rw').val();
                        dataRt = $('#data_rt').val();
                        dataKet = $('#data_ket').val();
                        dataTahun = $('#data_tahun').val();
                        // set a variable
                        var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                        if (dataRw === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                    footer: true
                },
            <?php } ?> {
                title: 'LAMPIRAN DATA PBB BELUM LUNAS 2022',
                extend: 'pdfHtml5',
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
                footer: true
            }, {
                title: 'LAMPIRAN DATA PBB BELUM LUNAS 2022',
                extend: 'print',
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
                footer: true
            },
        ],
    });

    // TABEL BERMASALAH
    table2 = $('#tb_dhkp22_2').DataTable({
        'order': [],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        "lengthChange": true,
        'responsive': true,
        'width': 100,
        'processing': true,
        'serverSide': true,
        "lengthMenu": [
            10, 25, 50, 100, 200, 400, 800, 1600, 3200
        ],
        "pageLength": 3200,
        // "lengthMenu": [
        //     10, 25, 50, 100, 200, 400, 800, 1600, 3200
        // ],
        "ajax": {
            "url": "<?= site_url('tb_dhkp22_2'); ?>",
            "type": "POST",
            "data": {
                "csrf_test_name": $('input[name=csrf_test_name]').val()
            },

            "data": function(data) {
                data.csrf_test_name = $('input[name=csrf_test_name]').val();
                data.data_desa = $('#data_desa').val();
                data.data_dusun = $('#data_dusun').val();
                data.data_rw = $('#data_rw').val();
                data.data_rt = $('#data_rt').val();
                data.data_ket = $('#data_ket').val();
                data.data_tahun = $('#data_tahun').val();
            },
            "dataSrc": function(response) {
                $('input[name=csrf_test_name]').val(response.csrf_test_name);
                return response.data;
            }
        },
        drawCallback: function(settings) {
            $('#total_order2').html(settings.json.total);
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        dom: 'lBfrtip',
        buttons: [
            //'pageLength',
            // 'excel', 'pdf', 'print',
            <?php if (session()->get('level') == 1) { ?>

                {
                    title: 'LAMPIRAN DATA PBB BERMASALAH 2022',
                    extend: 'excelHtml5',
                    messageTop: function() {
                        dataDesa = $('#data_desa').val();
                        dataDusun = $('#data_dusun').val();
                        dataRw = $('#data_rw').val();
                        dataRt = $('#data_rt').val();
                        dataKet = $('#data_ket').val();
                        dataTahun = $('#data_tahun').val();
                        // set a variable
                        var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                        if (dataRw === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                    footer: true
                },
            <?php } ?> {
                title: 'LAMPIRAN DATA PBB BERMASALAH 2022',
                extend: 'pdfHtml5',
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
                footer: true
            }, {
                title: 'LAMPIRAN DATA PBB BELUM LUNAS 2022',
                extend: 'print',
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    dataTahun = $('#data_tahun').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataRw === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
                footer: true
            },
        ],

    });

    $('#data_desa').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });
    $('#data_dusun').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });
    $('#data_rw').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });
    $('#data_rt').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });
    $('#data_ket').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });
    $('#data_tahun').change(function() {
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $(document).ready(function() {

        $('#reload_page').click(function() {
            location.reload(true);
        });

        $('#tb_dhkp22');
        $('#tb_dhkp22_0');
        $('#tb_dhkp22_1');
        $('#tb_dhkp22_2');

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
                $('#data_rt').val('');
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

        $('.tombolTambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('formTambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalTambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('#nop').keydown(function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                cekNop();
            }
        })
    });


    function cekNop() {
        let nop = $('#nop').val();

        if (nop.length == 0) {
            $.ajax({
                url: "<?= site_url('dhkp22/tarikData'); ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.viewmodal).show();
                    $('#modalterhutang').modal('show');
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            $.ajax({
                type: "post",
                url: "<?= site_url('transaction21/simpanTemp'); ?>",
                data: {
                    nop: nop,
                    pajak: $('#pajak').val(),
                    ket: $('#ket').val(),
                    nofaktur: $('#nofaktur').val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.totaldata == 'banyak') {
                        $.ajax({
                            url: "<?= site_url('transaction21/dataTerhutang'); ?>",
                            dataType: "json",
                            data: {
                                keyword: nop
                            },
                            type: "post",
                            success: function(response) {
                                $('.viewmodal').html(response.viewmodal).show();
                                $('#modalterhutang').modal('show');
                            },
                            error: function(xhr, thrownError) {
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                            }
                        });
                    }
                    if (response.sukses == 'berhasil') {
                        tb_dhkp22();
                        kosong();
                    }
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: response.error
                        });
                        tb_dhkp22();
                        kosong();
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    }

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    $(document).on('click', '#tmbDelet', function() {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        // alert(dv_id);
        // $('.editIndivdv_idu').modal('show');
        tanya = confirm(`YAKIN? ANDA MENGHAPUS DATA "${nama}"`);
        if (tanya == true) {
            $.ajax({
                type: "post",
                url: "<?= base_url('dltPbb'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.sukses,
                        });
                        // window.location.reload();
                        table.draw();

                    }
                }
            });
        }

    });

    function edit_person(id) {
        //Ajax Load data from ajax
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('editPbb') ?>",
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