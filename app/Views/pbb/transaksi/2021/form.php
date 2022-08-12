<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper mt-1">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form class="form-group row mt-3" action="<?= base_url('dhkp21/cari'); ?>" action="get">
                <label for="nop" class="col-4 col-form-label">Cari Nomor Objek Pajak</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="cari" aria-describedby="cari" autofocus value="32.07.040.008.">
                </div>
                <button type="submit" class="btn btn-primary" value="Cari">Cari</button>
            </form>
        </div>
    </section>
</div>



<?= $this->endSection(); ?>