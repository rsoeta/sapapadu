<div class="modal fade" id="hasil_pencarian" aria-hidden="true" aria-labelledby="hasil_pencarianLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="card">
        <div class="card-header h4 text-center">
          KolektorPBB - Notif
          <br>
        </div>
        <div class="card-body">
          <h6 class="card-title">Yth:</h6>
          <p class="card-text">Menurut database kami sampai saat ini bahwa SPPT dengan No. Objek Pajak :
            <strong><?= $nop; ?></strong>
            <br>
            Atasnama : <?= $nama_wp; ?>
            <br>
            Yang berlokasi di : <?= strtoupper($alamat_op); ?>
            <br>
            Berstatus : <?php if ($ket == 0) {
                          echo "<strong>TELAH LUNAS.</strong><br><br><strong>--TERIMA KASIH--</strong>";
                        } else if ($ket >= 1) {
                          echo "<strong>BELUM LUNAS.</strong>";
                        } ?>
          </p>
        </div>
        <div class="card-footer text-muted">
          <p><small class="text-muted">Last updated : <strong><?= date('D, d M Y H:m:s'); ?></strong></small></p>
          <button class="btn btn-sm btn-primary d-inline-block w-100" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>