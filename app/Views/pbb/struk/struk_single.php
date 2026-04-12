<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk PBB</title>
    <style>
        body {
            font-family: monospace;
            font-size: 12px;
            width: 80mm;
            margin: auto;
            color: #000;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .small {
            font-size: 10px;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }

        .section {
            margin-bottom: 4px;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .qr {
            display: block;
            margin: 10px auto;
            width: 90px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 11px;
        }

        @media print {
            body {
                width: 80mm;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="center">
        <img src="<?= logoApp(); ?>" width="40">
        <div class="title"><?= namaApp(); ?></div>
        <div class="subtitle"><?= deskApp(); ?></div>
        <div class="small"><?= detailUser()->nm_desa ?? '' ?> - <?= detailUser()->nm_kec ?? '' ?> - <?= detailUser()->nm_kab ?? '' ?></div>
    </div>

    <div class="line"></div>

    <div class="center bold">
        TANDA TERIMA PBB-P2
    </div>

    <div class="line"></div>

    <!-- INFO TRANSAKSI -->
    <div class="section">
        <div class="row">
            <span>No</span>
            <span><?= $tr_faktur ?></span>
        </div>
        <div class="row">
            <span>Tanggal</span>
            <span><?= $tgl_format ?></span>
        </div>
    </div>

    <div class="line"></div>

    <!-- DATA WP -->
    <div class="section">
        <div class="bold"><?= $nama_wp ?></div>
        <div class="small"><?= $alamat_wp ?></div>
    </div>

    <div class="line"></div>

    <!-- DETAIL -->
    <div class="section">
        <div class="row">
            <span>NOP</span>
            <span><?= $nop ?></span>
        </div>
        <div class="row">
            <span>Tahun</span>
            <span><?= date('Y', strtotime($tr_tgl)) ?></span>
        </div>
        <div class="row">
            <span>Pajak</span>
            <span>Rp <?= number_format($pajak, 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="line"></div>

    <!-- TOTAL -->
    <div class="section bold">
        <div class="row">
            <span>TOTAL</span>
            <span>Rp <?= number_format($tr_totalbersih, 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="line"></div>

    <!-- TERBILANG -->
    <div class="center small">
        "<?= strtoupper($terbilang) ?>"
    </div>

    <div class="line"></div>

    <!-- QR -->
    <img src="<?= base_url('qr/generate?data=' . urlencode($validasi_url)) ?>" class="qr">

    <div class="center small">
        Scan untuk verifikasi
    </div>

    <div class="line"></div>

    <!-- FOOTER -->
    <div class="center small">
        Petugas<br><br>
        <span class="bold"><?= detailUser()->full_name ?? 'SAPAPADU' ?></span>
    </div>

    <div class="center small" style="margin-top:6px;">
        Terima kasih telah membayar PBB
    </div>

    <script>
        window.print();
    </script>

</body>

</html>