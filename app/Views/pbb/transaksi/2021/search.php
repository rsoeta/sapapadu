<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">

    <div class="col-md-12 col-md-offset-1">
        <hr />
        <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-xs-3">Kode Barang</label>
                <div class="col-xs-9">
                    <input name="nop" id="nop" name="nop" class="form-control" type="text" placeholder="Kode Barang..." style="width:335px;" value="32.07.040.008.">
                </div>
                <div class="col-xs">
                    <button type="button" id="btn-search">Cari..</button><span id="loading">LOADING...</span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Nama Barang</label>
                <div class="col-xs-9">
                    <input name="nama_wp" id="nama_wp" class="form-control" type="text" placeholder="Nama Barang..." style="width:335px;" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Harga</label>
                <div class="col-xs-9">
                    <input name="alamat_wp" id="alamat_wp" class="form-control" type="text" placeholder="Harga..." style="width:335px;" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Satuan</label>
                <div class="col-xs-9">
                    <input name="alamat_op" id="alamat_op" class="form-control" type="text" placeholder="Satuan..." style="width:335px;" readonly>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3">Satuan</label>
                <div class="col-xs-9">
                    <input name="bgn" id="bgn" class="form-control" type="text" placeholder="Satuan..." style="width:335px;" readonly>
                </div>
            </div>
        </form>
    </div>
</div>


<?= $this->endsection(); ?>