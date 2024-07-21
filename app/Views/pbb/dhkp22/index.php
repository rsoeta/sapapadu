<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<style>
    td.highlight {
        background-color: aquamarine !important;
    }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">


<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?= base_url(); ?>/assets/dataTables/DataTables-1.10.24/js/jquery.dataTables.min.js"></script> -->

<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script> -->
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

<!-- <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.colVis.min.js"></script> -->
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->

<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
<!-- <script src="<?= base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->

<!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script> -->

<script src="<?= base_url(); ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<?php
$role = detailUser()->pu_role_id;
// echo session()->get('pu_nik');
?>
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
                                <button type="button" class="btn btn-tool reload_page" data-card-widget="refresh" id="reload_page">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- start area export data -->
                        <?= form_open('Dhkp22/exportExcel', ['target' => 'blank']); ?>
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
                                                    <option value="">- Semua -</option>
                                                    <?php foreach ($ketBayar as $item) { ?>
                                                        <option value="<?= $item['sta_id']; ?>"><?= $item['sta_keterangan']; ?></option>
                                                    <?php } ?>
                                                    <!-- <option value="1">Belum Bayar</option>
                                                    <option value="0">Lunas</option> -->
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
                            <h5 class="card-title">Rekap PBB</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool reload_page" data-card-widget="refresh" id="reload_page">
                                    <i class="fa fa-refresh"></i>
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
                                            <h5>DATA TARGET</h5>
                                            <h4 id="jumlahSppt">SPPT</h4>
                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-database"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header" id=jumlahTotal>Rp. </h5>
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
                                            <h4 id="jumlahLunas"> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-file-invoice-dollar"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header" id="jumlahTotalLunas">Rp. </h5>
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
                                            <h4 id="jumlahBelumLunas"> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-handshake-slash"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header" id="jumlahTotalBelumLunas">Rp. </h5>
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
                                            <h4 id="jumlahBermasalah"> SPPT</h4>

                                        </div>
                                        <div class="icon">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <div class="card-footer-sm bg-light">
                                            <div class="row">
                                                <div class="col-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header" id="jumlahTotalBermasalah">Rp. </h5>
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
                                <button type="button" class="btn btn-tool reload_page" data-card-widget="refresh" id="reload_page">
                                    <i class="fa fa-refresh"></i>
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
                                            <div class="btn-group float-right">
                                                <button type="button" class="btn btn-secondary">Pilih Aksi</button>
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <button type="button" class="dropdown-item btn btn-primary rounded shadow tombolTambah">
                                                        <i class="fa fa-folder-plus mr-1"></i> Tambah Data
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button type="button" id='delete_record' value='Delete' class="dropdown-item btn btn-danger rounded shadow">
                                                        <i class="fa fa-trash-alt mr-1"></i> Hapus Data Terpilih
                                                    </button>
                                                    <div class="dropdown-divider"></div>
                                                    <button type="submit" id='exportExcel' value='Export' class="dropdown-item btn btn-danger rounded shadow">
                                                        <i class="fa fa-file-export mr-1"></i> Export Data
                                                    </button>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end area export -->
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
                                    <div id="msg"></div>
                                    <div class="table-responsive">
                                        <table id="tb_dhkp22" class="table table-hover table-sm nowrap compact" style="width: 100%;">
                                            <thead style="background-color: cyan; color: dark;">
                                                <tr role="row">
                                                    <th><input type="checkbox" class='checkall' id='checkall'></th>
                                                    <th>No</th>
                                                    <th>Nama WP</th>
                                                    <th>N.O.P</th>
                                                    <th>Alamat WP</th>
                                                    <th>Alamat OP</th>
                                                    <th>Bumi</th>
                                                    <th>Pajak (Rp.)</th>
                                                    <th>Nama Pemilik</th>
                                                    <th>Ket</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="7" style="text-align:center; text-decoration: black;">TOTAL</th>
                                                    <th style="text-align: right;" id="total_order"></th>
                                                    <th colspan="3"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <div class="tab-pane fade" id="lunas" role="tabpanel" aria-labelledby="lunas-tab">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <button style="float: right;" type="button" class="btn btn-success shadow" onclick="window.location='<?= site_url('/trx22-pembayaran'); ?>'">
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
                                                    <table id="tb_dhkp22_0" class="table table-hover nowrap compact" style="width: 100%;">
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
                                                                <!-- <th>No. Kuitansi</th> -->
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
                                                                <!-- <th>-</th> -->
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
                                                    <table id="tb_dhkp22_1" class="table table-hover nowrap compact" style="width: 100%;">
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
                                                <table id="tb_dhkp22_2" class="table table-hover nowrap compact" style="width: 100%;">
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
    $(document).ready(function() {
        // body collapsed
        // $('body').toggleClass('sidebar-collapse');
        $('.reload_page').click(function() {
            location.reload(true);
        });

        $('#tb_dhkp22');
        $('#tb_dhkp22_0');
        $('#tb_dhkp22_1');
        $('#tb_dhkp22_2');
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();

        $('#data_desa').change(function() {
            let data_desa = $('#data_desa').val();
            let action = 'get_dusun';
            if (data_desa != '') {
                $.ajax({
                    url: '<?= base_url('action') ?>',
                    type: 'post',
                    data: {
                        desa: data_desa,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        let html = '<option value="">-Semua Dusun-</option>';
                        for (let count = 0; count < data.length; count++) {
                            html += '<option value="' + data[count].td_kode_dusun + '">' + data[count].td_nama_dusun + '</option>'
                        }
                        $('#data_dusun').html(html);
                        $('#data_rw').html('<option value="">-Semua RW-</option>');
                        $('#data_rt').html('<option value="">-Semua RT-</option>');
                        jumlahSppt();
                        jumlahTotal();
                        jumlahLunas();
                        jumlahTotalLunas();
                        jumlahBelumLunas();
                        jumlahTotalBelumLunas();
                        jumlahBermasalah();
                        jumlahTotalBermasalah();
                    }
                });
            } else {
                $('#data_dusun').html('<option value="">Pilih Dusun</option>');
                $('#data_rw').html('<option value="">Pilih RW</option>');
                $('#data_rt').html('<option value="">Pilih RT</option>');
            }
        });

        $('#data_dusun').change(function() {
            let desa = $('#data_desa').val();
            let no_dusun = $('#data_dusun').val();
            let action = 'get_rw';
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
                        let html = '<option value="">-Semua RW-</option>';

                        for (let count = 0; count < data.length; count++) {

                            html += '<option value="' + data[count].no_rw + '">' + data[count].no_rw + '</option>';
                        }

                        $('#data_rw').html(html);
                        $('#data_rt').html('<option value="">-Semua RT-</option>');
                        jumlahSppt();
                        jumlahTotal();
                        jumlahLunas();
                        jumlahTotalLunas();
                        jumlahBelumLunas();
                        jumlahTotalBelumLunas();
                        jumlahBermasalah();
                        jumlahTotalBermasalah();
                    }
                });
            } else {
                $('#data_rw').val('');
                $('#data_rt').val('');
            }
        });

        $('#data_rw').change(function() {
            let desa = $('#data_desa').val();
            let no_rw = $('#data_rw').val();
            let action = 'get_rt';
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
                        let html = '<option value="">-Semua RT-</option>';

                        for (let count = 0; count < data.length; count++) {

                            html += '<option value="' + data[count].no_rt + '">' + data[count].no_rt + '</option>';

                        }
                        $('#data_rt').html(html);
                        jumlahSppt();
                        jumlahTotal();
                        jumlahLunas();
                        jumlahTotalLunas();
                        jumlahBelumLunas();
                        jumlahTotalBelumLunas();
                        jumlahBermasalah();
                        jumlahTotalBermasalah();
                    }
                });
            } else {
                $('#data_rt').val('');
            }
        });

        $('#data_rt').change(function() {
            jumlahSppt();
            jumlahTotal();
            jumlahLunas();
            jumlahTotalLunas();
            jumlahBelumLunas();
            jumlahTotalBelumLunas();
            jumlahBermasalah();
            jumlahTotalBermasalah();
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

        // Check all 
        $('#checkall').click(function() {
            if ($(this).is(':checked')) {
                $('.delete_check').prop('checked', true);
            } else {
                $('.delete_check').prop('checked', false);
            }
        });

        // Delete record
        $('#delete_record').click(function() {

            var deleteids_arr = [];
            // Read all checked checkboxes
            $("input:checkbox[class=delete_check]:checked").each(function() {
                deleteids_arr.push($(this).val());
            });

            // Check checkbox checked or not
            if (deleteids_arr.length > 0) {

                // Confirm alert
                var confirmdelete = confirm("Data akan dihapus permanen. \nYakin ingin menghapus data ini?");
                if (confirmdelete == true) {
                    $.ajax({
                        url: 'deleteSelected',
                        type: 'POST',
                        data: {
                            request: 2,
                            deleteids_arr: deleteids_arr
                        },
                        success: function(response) {
                            // get response from server with swalalert
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Data berhasil dihapus',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            jumlahSppt();
                            jumlahTotal();
                            jumlahLunas();
                            jumlahTotalLunas();
                            jumlahBelumLunas();
                            jumlahTotalBelumLunas();
                            jumlahBermasalah();
                            jumlahTotalBermasalah();
                            table.draw();
                            table0.draw();
                            table1.draw();
                            table2.draw();
                        }
                    });
                }
            }
        });

        $('.refreshAll').click(function() {
            jumlahSppt();
            jumlahTotal();
            jumlahLunas();
            jumlahTotalLunas();
            jumlahBelumLunas();
            jumlahTotalBelumLunas();
            jumlahBermasalah();
            jumlahTotalBermasalah();
            table.draw();
            table0.draw();
            table1.draw();
            table2.draw();
        });

        var table = $('#tb_dhkp22').DataTable();

    });

    // Checkbox checked
    function checkcheckbox() {

        // Total checkboxes
        var length = $('.delete_check').length;

        // Total checked checkboxes
        var totalchecked = 0;
        $('.delete_check').each(function() {
            if ($(this).is(':checked')) {
                totalchecked += 1;
            }
        });

        // Checked unchecked checkbox
        if (totalchecked == length) {
            $("#checkall").prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    }

    var table;
    var table0;
    var table1;
    var table2;
    moment.locale("id");

    table = $('#tb_dhkp22').DataTable({
        'order': [
            [3, 'asc']
        ],
        'fixedHeader': true,
        'searching': true,
        'paging': true,
        'responsive': true,
        'processing': true,
        'serverSide': true,
        'lengthMenu': [
            15, 30, 45, 60, 75, 90, 105, 120, 135, 150, 165, 180, 195, 210, 225, 240, 255, 270, 285, 300, 315, 330, 345, 360, 375, 390, 405, 420, 435, 450, 465, 480, 495, 510, 525, 540, 555, 570, 585, 600, 615, 630, 645, 660, 675, 690, 705, 720, 735, 750, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 960, 975, 990, 1005, 1020, 1035, 1050, 1065, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350, 1365, 1380, 1395, 1410, 1425, 1440, 1455, 1470, 1485, 1500, 1515, 1530, 1545, 1560, 1575, 1590, 1605, 1620, 1635, 1650, 1665, 1680, 1695, 1710, 1725, 1740, 1755, 1770, 1785, 1800, 1815, 1830, 1845, 1860, 1875, 1890, 1905, 1920, 1935, 1950, 1965, 1980, 1995, 2010, 2025, 2040, 2055, 2070, 2085, 2100, 2115, 2130, 2145, 2160, 2175, 2190, 2205, 2220, 2235, 2250, 2265, 2280, 2295, 2310, 2325, 2340, 2355, 2370, 2385, 2400, 2415, 2430, 2445, 2460, 2475, 2490, 2505, 2520, 2535, 2550, 2565, 2580, 2595, 2610, 2625, 2640, 2655, 2670, 2685, 2700, 2715, 2730, 2745, 2760, 2775, 2790, 2805, 2820, 2835, 2850, 2865, 2880, 2895, 2910, 2925, 2940, 2955, 2970, 2985, 3000, 3015, 3030, 3045, 3060, 3075, 3090, 3105, 3120, 3135, 3150, 3165, 3180, 3195, 3210, 3225, 3240, 3255, 3270, 3285, 3300, 3315, 3330, 3345, 3360, 3375, 3390, 3405, 3420, 3435, 3450, 3465, 3480, 3495, 3510,
        ],
        'pageLength': 15,

        'ajax': {
            'url': '<?= site_url('tb_dhkp22'); ?>',
            'type': 'POST',
            'data': {
                'csrf_test_name': $('input[name=csrf_test_name]').val()
            },

            'data': function(data) {
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
                "orderable": false,
                "targets": [0]
            },
            // {
            //     "visible": false,
            // "targets": [10],
            // },
            {
                targets: [6, 7],
                className: 'dt-right'
            }
        ],
        dom: 'lBfrtip',
        buttons: [
            'colvis',
            //'pageLength',
            <?php if (session()->get('level') == 1) { ?> {
                    // data_tahun = $('#data_tahun').val(),
                    title: function() {
                        return 'LAMPIRAN PBB TAHUN ' + $('#data_tahun').val();
                    },
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

                        if (dataDusun === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                },
            <?php } ?> {
                title: function() {
                    return 'LAMPIRAN PBB TAHUN ' + $('#data_tahun').val();
                },
                extend: 'print',
                footer: true,
                exportOptions: {
                    columns: ':visible'
                },
                columnDefs: [{
                    "visible": false,
                    "targets": -1,
                }, ],
                messageTop: function() {
                    dataDesa = $('#data_desa').val();
                    dataDusun = $('#data_dusun').val();
                    dataRw = $('#data_rw').val();
                    dataRt = $('#data_rt').val();
                    dataKet = $('#data_ket').val();
                    // set a variable
                    var dataTanggal = moment().format("dddd, Do MMMM YYYY, h:mm:ss a"); // September 4 2017, 10:53:16 pagi

                    if (dataDusun === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else if (dataDusun !== '' && dataRw !== '') {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
            }
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
            15, 30, 45, 60, 75, 90, 105, 120, 135, 150, 165, 180, 195, 210, 225, 240, 255, 270, 285, 300, 315, 330, 345, 360, 375, 390, 405, 420, 435, 450, 465, 480, 495, 510, 525, 540, 555, 570, 585, 600, 615, 630, 645, 660, 675, 690, 705, 720, 735, 750, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 960, 975, 990, 1005, 1020, 1035, 1050, 1065, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350, 1365, 1380, 1395, 1410, 1425, 1440, 1455, 1470, 1485, 1500, 1515, 1530, 1545, 1560, 1575, 1590, 1605, 1620, 1635, 1650, 1665, 1680, 1695, 1710, 1725, 1740, 1755, 1770, 1785, 1800, 1815, 1830, 1845, 1860, 1875, 1890, 1905, 1920, 1935, 1950, 1965, 1980, 1995, 2010, 2025, 2040, 2055, 2070, 2085, 2100, 2115, 2130, 2145, 2160, 2175, 2190, 2205, 2220, 2235, 2250, 2265, 2280, 2295, 2310, 2325, 2340, 2355, 2370, 2385, 2400, 2415, 2430, 2445, 2460, 2475, 2490, 2505, 2520, 2535, 2550, 2565, 2580, 2595, 2610, 2625, 2640, 2655, 2670, 2685, 2700, 2715, 2730, 2745, 2760, 2775, 2790, 2805, 2820, 2835, 2850, 2865, 2880, 2895, 2910, 2925, 2940, 2955, 2970, 2985, 3000, 3015, 3030, 3045, 3060, 3075, 3090, 3105, 3120, 3135, 3150, 3165, 3180, 3195, 3210, 3225, 3240, 3255, 3270, 3285, 3300, 3315, 3330, 3345, 3360, 3375, 3390, 3405, 3420, 3435, 3450, 3465, 3480, 3495, 3510,
        ],
        "pageLength": 15,
        "ajax": {
            "url": "<?= site_url('/tb_dhkp22_lunas'); ?>",
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
                    title: function() {
                        return 'LAMPIRAN PBB LUNAS TAHUN ' + $('#data_tahun').val();
                    },
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

                        if (dataDusun === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else if (dataDusun !== '' && dataRw !== '') {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                },
            <?php } ?> {
                title: function() {
                    return 'LAMPIRAN PBB LUNAS TAHUN ' + $('#data_tahun').val();
                },
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

                    if (dataDusun === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else if (dataDusun !== '' && dataRw !== '') {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
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
            15, 30, 45, 60, 75, 90, 105, 120, 135, 150, 165, 180, 195, 210, 225, 240, 255, 270, 285, 300, 315, 330, 345, 360, 375, 390, 405, 420, 435, 450, 465, 480, 495, 510, 525, 540, 555, 570, 585, 600, 615, 630, 645, 660, 675, 690, 705, 720, 735, 750, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 960, 975, 990, 1005, 1020, 1035, 1050, 1065, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350, 1365, 1380, 1395, 1410, 1425, 1440, 1455, 1470, 1485, 1500, 1515, 1530, 1545, 1560, 1575, 1590, 1605, 1620, 1635, 1650, 1665, 1680, 1695, 1710, 1725, 1740, 1755, 1770, 1785, 1800, 1815, 1830, 1845, 1860, 1875, 1890, 1905, 1920, 1935, 1950, 1965, 1980, 1995, 2010, 2025, 2040, 2055, 2070, 2085, 2100, 2115, 2130, 2145, 2160, 2175, 2190, 2205, 2220, 2235, 2250, 2265, 2280, 2295, 2310, 2325, 2340, 2355, 2370, 2385, 2400, 2415, 2430, 2445, 2460, 2475, 2490, 2505, 2520, 2535, 2550, 2565, 2580, 2595, 2610, 2625, 2640, 2655, 2670, 2685, 2700, 2715, 2730, 2745, 2760, 2775, 2790, 2805, 2820, 2835, 2850, 2865, 2880, 2895, 2910, 2925, 2940, 2955, 2970, 2985, 3000, 3015, 3030, 3045, 3060, 3075, 3090, 3105, 3120, 3135, 3150, 3165, 3180, 3195, 3210, 3225, 3240, 3255, 3270, 3285, 3300, 3315, 3330, 3345, 3360, 3375, 3390, 3405, 3420, 3435, 3450, 3465, 3480, 3495, 3510,
        ],
        "pageLength": 15,
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
                    title: function() {
                        return 'LAMPIRAN PBB BELUM LUNAS TAHUN ' + $('#data_tahun').val();
                    },
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

                        if (dataDusun === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else if (dataDusun !== '' && dataRw !== '') {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                    footer: true
                },
            <?php } ?> {
                title: 'LAMPIRAN PBB BELUM LUNAS TAHUN ' + $('#data_tahun').val(),
                title: function() {
                    return 'LAMPIRAN PBB BELUM LUNAS TAHUN ' + $('#data_tahun').val();
                },
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

                    if (dataDusun === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else if (dataDusun !== '' && dataRw !== '') {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
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
            15, 30, 45, 60, 75, 90, 105, 120, 135, 150, 165, 180, 195, 210, 225, 240, 255, 270, 285, 300, 315, 330, 345, 360, 375, 390, 405, 420, 435, 450, 465, 480, 495, 510, 525, 540, 555, 570, 585, 600, 615, 630, 645, 660, 675, 690, 705, 720, 735, 750, 765, 780, 795, 810, 825, 840, 855, 870, 885, 900, 915, 930, 945, 960, 975, 990, 1005, 1020, 1035, 1050, 1065, 1080, 1095, 1110, 1125, 1140, 1155, 1170, 1185, 1200, 1215, 1230, 1245, 1260, 1275, 1290, 1305, 1320, 1335, 1350, 1365, 1380, 1395, 1410, 1425, 1440, 1455, 1470, 1485, 1500, 1515, 1530, 1545, 1560, 1575, 1590, 1605, 1620, 1635, 1650, 1665, 1680, 1695, 1710, 1725, 1740, 1755, 1770, 1785, 1800, 1815, 1830, 1845, 1860, 1875, 1890, 1905, 1920, 1935, 1950, 1965, 1980, 1995, 2010, 2025, 2040, 2055, 2070, 2085, 2100, 2115, 2130, 2145, 2160, 2175, 2190, 2205, 2220, 2235, 2250, 2265, 2280, 2295, 2310, 2325, 2340, 2355, 2370, 2385, 2400, 2415, 2430, 2445, 2460, 2475, 2490, 2505, 2520, 2535, 2550, 2565, 2580, 2595, 2610, 2625, 2640, 2655, 2670, 2685, 2700, 2715, 2730, 2745, 2760, 2775, 2790, 2805, 2820, 2835, 2850, 2865, 2880, 2895, 2910, 2925, 2940, 2955, 2970, 2985, 3000, 3015, 3030, 3045, 3060, 3075, 3090, 3105, 3120, 3135, 3150, 3165, 3180, 3195, 3210, 3225, 3240, 3255, 3270, 3285, 3300, 3315, 3330, 3345, 3360, 3375, 3390, 3405, 3420, 3435, 3450, 3465, 3480, 3495, 3510,

        ],
        "pageLength": 3510,
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
            <?php if (session()->get('level') == 1) { ?> {
                    title: function() {
                        return 'LAMPIRAN PBB BERMASALAH TAHUN ' + $('#data_tahun').val();
                    },
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

                        if (dataDusun === '') {
                            return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                        } else if (dataDusun !== '' && dataRw !== '') {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        } else {
                            return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                        }
                    },
                    footer: true
                },
            <?php } ?> {
                title: function() {
                    return 'LAMPIRAN PBB BERMASALAH TAHUN ' + $('#data_tahun').val();
                },
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

                    if (dataDusun === '') {
                        return 'Se-Desa Pasirlangu.' + ' | Dicetak pada : ' + dataTanggal;
                    } else if (dataDusun !== '' && dataRw !== '') {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    } else {
                        return 'DUSUN  : ' + dataDusun + '\nRW         : ' + dataRw + '\nRT           : ' + dataRt + ' | Dicetak pada :' + dataTanggal;
                    }
                },
                footer: true
            },
        ],

    });

    $('#data_desa').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $('#data_dusun').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $('#data_rw').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $('#data_rt').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $('#data_ket').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    $('#data_tahun').change(function() {
        jumlahSppt();
        jumlahTotal();
        jumlahLunas();
        jumlahTotalLunas();
        jumlahBelumLunas();
        jumlahTotalBelumLunas();
        jumlahBermasalah();
        jumlahTotalBermasalah();
        table.draw();
        table0.draw();
        table1.draw();
        table2.draw();
    });

    function jumlahSppt() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        let jumlahSppt = $('#jumlahSppt').val();
        $.ajax({
            url: '<?= base_url('jumlahSppt') ?>',
            dataType: 'json',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}',
                jumlahSppt: jumlahSppt
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlSppt = jml + ' SPPT';
                $('#jumlahSppt').text(jmlSppt);
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function jumlahLunas() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        let jumlahLunas = $('#jumlahLunas').val();
        $.ajax({
            url: '<?= base_url('jumlahLunas') ?>',
            dataType: 'json',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}',
                jumlahLunas: jumlahLunas
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlLunas = jml + ' SPPT';
                $('#jumlahLunas').text(jmlLunas);
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function jumlahBelumLunas() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        let jumlahBelumLunas = $('#jumlahBelumLunas').val();
        $.ajax({
            url: '<?= base_url('jumlahBelumLunas') ?>',
            dataType: 'json',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}',
                jumlahBelumLunas: jumlahBelumLunas
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlBelumLunas = jml + ' SPPT';
                $('#jumlahBelumLunas').text(jmlBelumLunas);
            }
        });
    }

    function jumlahBermasalah() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        let jumlahBermasalah = $('#jumlahBermasalah').val();
        $.ajax({
            url: '<?= base_url('jumlahBermasalah') ?>',
            dataType: 'json',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}',
                jumlahBermasalah: jumlahBermasalah
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlBermasalah = jml + ' SPPT';
                $('#jumlahBermasalah').text(jmlBermasalah);
            }
        });
    }

    function jumlahTotal() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        $.ajax({
            url: '<?= base_url('jumlahTotal'); ?>',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                let jumlahTotal = document.querySelector("#jumlahTotal");
                let jml = formatNumber(data);
                let jmlTotal = 'Rp. ' + jml + ',-';
                jumlahTotal.textContent = jmlTotal;
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function jumlahTotalLunas() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        $.ajax({
            url: '<?= base_url('jumlahTotalLunas'); ?>',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlTotal = 'Rp. ' + jml + ',-';
                $('#jumlahTotalLunas').text(jmlTotal);
            }
        });
    }

    function jumlahTotalBelumLunas() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        $.ajax({
            url: '<?= base_url('jumlahTotalBelumLunas'); ?>',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlTotal = 'Rp. ' + jml + ',-';
                $('#jumlahTotalBelumLunas').text(jmlTotal);
            }
        });
    }

    function jumlahTotalBermasalah() {
        let data_desa = $('#data_desa').val();
        let data_dusun = $('#data_dusun').val();
        let data_rw = $('#data_rw').val();
        let data_rt = $('#data_rt').val();
        let data_ket = $('#data_ket').val();
        let data_tahun = $('#data_tahun').val();
        $.ajax({
            url: '<?= base_url('jumlahTotalBermasalah'); ?>',
            type: 'POST',
            data: {
                data_desa: data_desa,
                data_dusun: data_dusun,
                data_rw: data_rw,
                data_rt: data_rt,
                data_ket: data_ket,
                data_tahun: data_tahun,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                let jml = formatNumber(data);
                let jmlTotal = 'Rp. ' + jml + ',-';
                $('#jumlahTotalBermasalah').text(jmlTotal);
            }
        });
    }

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
                        jumlahSppt();
                        jumlahTotal();
                        jumlahLunas();
                        jumlahTotalLunas();
                        jumlahBelumLunas();
                        jumlahTotalBelumLunas();
                        jumlahBermasalah();
                        jumlahTotalBermasalah();
                        table.draw();
                        table0.draw();
                        table1.draw();
                        table2.draw();

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

    $(function() {
        $('#exportExcel').click(function() {
            var $elt = $('#data_desa').removeAttr('disabled', '');
            setTimeout(function() {
                $elt.attr('disabled', true);
            }, 500);

        });
    });
</script>
<?= $this->endSection(); ?>