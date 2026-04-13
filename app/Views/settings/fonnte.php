<?= $this->extend('pbb/templates/index'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h4>Setting Token Fonnte</h4>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session('success') ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('settings/save-fonnte') ?>">
                <div class="form-group">
                    <label>Token Fonnte</label>
                    <input
                        type="text"
                        name="token"
                        class="form-control"
                        value="<?= esc($token) ?>"
                        required>
                </div>

                <button class="btn btn-primary mt-3">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>