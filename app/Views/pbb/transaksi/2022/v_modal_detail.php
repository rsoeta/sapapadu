<div class="modal fade" id="modalDetailTransaksi" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">

            <div class="modal-header text-white" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); border-bottom: none; padding: 20px 24px;">
                <h5 class="modal-title font-weight-bold" id="modalDetailLabel" style="font-family: 'Quicksand', sans-serif;">
                    <i class="fas fa-receipt mr-2"></i> Detail Transaksi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1; text-shadow: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body p-4" style="background-color: #f8fafc; font-family: 'Quicksand', sans-serif;">

                <div class="row mb-4">
                    <div class="col-sm-6">
                        <p class="text-muted text-xs font-weight-bold text-uppercase mb-1">No. Faktur</p>
                        <h5 class="font-weight-bold text-primary mb-3"><?= $header['tr_faktur']; ?></h5>

                        <p class="text-muted text-xs font-weight-bold text-uppercase mb-1">Tanggal Bayar</p>
                        <p class="font-weight-bold text-dark"><?= date('d M Y H:i', strtotime($header['tr_tgl'])); ?></p>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <p class="text-muted text-xs font-weight-bold text-uppercase mb-1">Penyetor (Wajib Pajak)</p>
                        <h5 class="font-weight-bold text-dark mb-1"><?= $header['nama_pelanggan'] ?? 'Hamba Allah'; ?></h5>
                        <p class="text-muted text-sm mb-3"><i class="fas fa-phone-alt mr-1"></i> <?= $header['no_hp'] ?? '-'; ?></p>
                    </div>
                </div>

                <div class="table-responsive bg-white rounded-lg shadow-sm border border-light">
                    <table class="table table-borderless table-hover mb-0">
                        <thead class="bg-light text-muted" style="border-bottom: 2px solid #f1f5f9;">
                            <tr>
                                <th class="text-uppercase text-xs font-weight-bold py-3 pl-4">Objek Pajak (NOP)</th>
                                <th class="text-uppercase text-xs font-weight-bold py-3 text-center">Tahun</th>
                                <th class="text-uppercase text-xs font-weight-bold py-3 text-right pr-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr style="border-bottom: 1px solid #f1f5f9;">
                                    <td class="py-3 pl-4">
                                        <div class="font-weight-bold text-dark"><?= $item['nop']; ?></div>
                                        <div class="text-xs text-muted"><?= $item['nama_wp'] ?? '-'; ?></div>
                                    </td>
                                    <td class="py-3 text-center align-middle font-weight-bold text-secondary">
                                        <?= date('Y', strtotime($header['tr_tgl'])); ?>
                                    </td>
                                    <td class="py-3 text-right pr-4 align-middle font-weight-bold text-dark">
                                        Rp <?= number_format($item['dettr_subtotal'], 0, ',', '.'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-right">
                        <p class="text-muted text-sm font-weight-bold text-uppercase mb-1">Total Pembayaran</p>
                        <h3 class="font-weight-bold" style="color: #10b981;">Rp <?= number_format($header['tr_totalbersih'], 0, ',', '.'); ?></h3>
                    </div>
                </div>

            </div>

            <div class="modal-footer bg-white border-top-0 py-3 px-4">
                <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">Tutup</button>

                <?php
                // Menggunakan helper bawaan SAPAPADU
                $faktur_clean = str_replace('#', '', $header['tr_faktur']);

                // Cek apakah transaksinya kolektif atau single
                if (count($items) > 1) {
                    // Arahkan ke struk_kolektif.php
                    $link_cetak = base_url("print/struk-kolektif/{$faktur_clean}/" . struk_token($faktur_clean));
                } else {
                    // Arahkan ke struk_single.php menggunakan helper
                    $link_cetak = struk_url($header['tr_faktur']);
                }
                ?>
                <button type="button" class="btn text-white font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);" onclick="window.open('<?= $link_cetak; ?>', '_blank')">
                    <i class="fas fa-print mr-1"></i> Cetak Ulang Struk
                </button>
            </div>

        </div>
    </div>
</div>