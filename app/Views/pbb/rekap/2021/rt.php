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
                            <button type="button" class="btn btn-success float-right" onclick="window.location='<?= site_url('pbb/exportRekRT'); ?>'" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Export
                            </button>
                            <button type="button" class="btn btn-primary float-right" onclick="window.location='<?= site_url('pbb/transaction21/pembayaran'); ?>'" style="margin-right: 5px;">
                                <i class="fa fa-plus-circle"></i> Tambah Transaksi
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
                                <div class="table table-responsive rekRt"></div>

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
    function rekRt() {
        $.ajax({
            url: "<?= site_url('pbb/transaction21/ambildatarekRt'); ?>",
            dataType: "json",
            success: function(response) {
                $('.rekRt').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
    $(document).ready(function() {
        rekRt();

        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('pbb/rekRt/formtambah') ?>",
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
    });
</script>
<?= $this->endSection(); ?>