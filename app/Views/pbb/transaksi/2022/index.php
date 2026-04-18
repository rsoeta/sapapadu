<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<style>
    /* Mengadaptasi nuansa Elegant dari Dashboard */
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap');

    .content-wrapper {
        font-family: 'Quicksand', sans-serif;
        background-color: #f8fafc;
    }

    .elegant-card {
        background: #ffffff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .elegant-card-header {
        background-color: #ffffff;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-elegant-primary {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-elegant-primary:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(14, 165, 233, 0.3);
    }

    .btn-elegant-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-elegant-success:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);
    }

    .page-title {
        font-weight: 700;
        color: #0f172a;
        font-size: 1.5rem;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid py-2">
            <div class="row align-items-center mb-3">
                <div class="col-sm-6">
                    <h1 class="m-0 page-title"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0 text-sm font-weight-bold">
                        <li class="breadcrumb-item"><a href="dashboard-v2" class="text-muted text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active text-primary"><?= $title; ?></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card elegant-card">
                        <div class="elegant-card-header">
                            <h5 class="m-0 font-weight-bold text-secondary"><i class="fas fa-list"></i> <?= $title; ?></h5>
                            <div>
                                <button type="button" class="btn btn-elegant-success mr-2" onclick="window.location='<?= site_url('export22'); ?>'">
                                    <i class="fas fa-file-excel"></i> Export
                                </button>
                                <button type="button" class="btn btn-elegant-primary tomboltambah" onclick="window.location='<?= site_url('/trx22-pembayaran'); ?>'">
                                    <i class="fa fa-plus-circle"></i> Tambah Transaksi
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-4">

                            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                <div class="alert alert-success border-0 rounded-lg shadow-sm">
                                    <i class="fas fa-check-circle mr-2"></i> <?php echo session()->getFlashdata('success'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty(session()->getFlashdata('info'))) : ?>
                                <div class="alert alert-info border-0 rounded-lg shadow-sm">
                                    <i class="fas fa-info-circle mr-2"></i> <?php echo session()->getFlashdata('info'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty(session()->getFlashdata('warning'))) : ?>
                                <div class="alert alert-warning border-0 rounded-lg shadow-sm">
                                    <i class="fas fa-exclamation-triangle mr-2"></i> <?php echo session()->getFlashdata('warning'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="trans21 w-100"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>

<script>
    function trans21() {
        $.ajax({
            type: "POST",
            url: "<?= site_url('trx22AmbilData'); ?>",
            dataType: "json",
            success: function(response) {
                $('.trans21').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        trans21();

        // Catatan: Script tomboltambah bawaan sebelumnya saya pertahankan di sini, 
        // tapi pastikan tidak bentrok dengan onclick window.location di tombolnya.
        // Jika form tambah dipindah ke modal, gunakan script ini.
    });
</script>
<?= $this->endSection(); ?>