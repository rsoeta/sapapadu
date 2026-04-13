<!DOCTYPE html>
<html>

<head>
    <title>Validasi Pembayaran PBB</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 15px;
        }

        /* CONTAINER */
        .wrapper {
            max-width: 480px;
            margin: auto;
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
        }

        /* HEADER */
        .center {
            text-align: center;
        }

        .logo {
            width: 60px;
            margin-bottom: 8px;
        }

        .title {
            font-weight: bold;
            font-size: 16px;
        }

        .subtitle {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }

        /* STATUS */
        .status {
            background: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 15px;
        }

        /* INFO */
        .info {
            font-size: 13px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 4px;
        }

        .label {
            color: #555;
        }

        .value {
            font-weight: bold;
            text-align: right;
        }

        /* QR */
        .qr {
            text-align: center;
            margin-top: 10px;
        }

        .qr img {
            width: 90px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #777;
            margin-top: 10px;
        }

        .card {
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        /* ========================= */
        /* 🔥 DESKTOP UPGRADE */
        /* ========================= */
        @media (min-width: 768px) {

            body {
                padding: 40px;
            }

            .wrapper {
                max-width: 600px;
            }

            .card {
                padding: 25px;
            }

            .title {
                font-size: 20px;
            }

            .status {
                font-size: 16px;
                padding: 12px;
            }

            .info {
                font-size: 14px;
            }

            .qr img {
                width: 110px;
            }

        }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="card">

            <!-- HEADER -->
            <div class="center">
                <img src="<?= logoApp(); ?>" class="logo">
                <div class="title"><?= namaApp(); ?></div>
                <div class="subtitle">Validasi Pembayaran PBB-P2</div>
            </div>

            <!-- STATUS -->
            <div class="status center">
                ✔ PEMBAYARAN VALID
            </div>

            <div style="font-size:11px; color:#fff; opacity:.8;">
                Sistem Verifikasi Digital
            </div>

            <!-- DATA UTAMA -->
            <div class="info">

                <div class="row">
                    <div class="label">No Transaksi</div>
                    <div class="value"><?= $data['tr_faktur'] ?></div>
                </div>

                <div class="row">
                    <div class="label">Tanggal</div>
                    <div class="value"><?= date('d-m-Y H:i', strtotime($data['tr_tgl'])) ?></div>
                </div>

                <div class="row">
                    <div class="label">Total</div>
                    <div class="value">Rp <?= number_format($data['tr_totalbersih'], 0, ',', '.') ?></div>
                </div>

            </div>

            <div class="divider"></div>

            <!-- DATA WP -->
            <?php if (!empty($data['nama_pelanggan'])): ?>
                <div class="info">

                    <div class="row">
                        <div class="label">Nama WP</div>
                        <div class="value"><?= $data['nama_pelanggan'] ?></div>
                    </div>

                    <div class="row">
                        <div class="label">No HP</div>
                        <div class="value"><?= $data['no_hp'] ?></div>
                    </div>

                </div>
            <?php endif; ?>

            <!-- QR -->
            <div class="qr">
                <img src="<?= base_url('qr/generate?data=' . current_url()) ?>">
            </div>

            <!-- FOOTER -->
            <div class="footer">
                Dokumen ini dihasilkan oleh sistem SAPAPADU<br>
                dan dapat diverifikasi secara digital
            </div>

        </div>
    </div>

</body>

</html>