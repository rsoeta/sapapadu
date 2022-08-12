<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper mt-1">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <strong>Terima Pembayaran</strong>
                        </div>
                        <div class="card-body card-block">

                            <div class="row form-group">
                                <div class="col">
                                    <select name="select" id="select" class="selectpicker form-control" data-container="body" data-live-search="true" required>
                                        <option value="0">Please select</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endsection(); ?>