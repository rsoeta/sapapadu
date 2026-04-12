<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk Kolektif PBB</title>

    <style>
        body {
            font-family: "Courier New", monospace;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        /* 🔥 KOP */
        .kop {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 5px double black;
            padding-bottom: 10px;
        }

        .kop-logo {
            width: 80px;
            text-align: center;
        }

        .kop-logo img {
            width: 70px;
            opacity: 0.9;
        }

        .kop-text {
            text-align: center;
            flex: 1;
            font-family: "Bookman Old Style", serif;
        }

        .kop-text h1 {
            font-size: 28px;
            letter-spacing: 10px;
            margin: 0;
        }

        .kop-text h3 {
            margin: 2px 0;
            font-size: 16px;
        }

        .kop-text h4 {
            margin: 2px 0;
            font-weight: normal;
        }

        .kop-text h6 {
            margin: 2px 0;
            font-weight: normal;
            font-size: 11px;
        }

        /* 🔥 CONTENT */
        .title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0;
            font-size: 14px;
        }

        .info {
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background: #f0f0f0;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .total {
            margin-top: 10px;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        .terbilang {
            margin-top: 5px;
            font-style: italic;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        @media print {
            body {
                margin: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- 🔥 KOP BARU -->
        <div class="kop">

            <!-- Logo Kiri -->
            <div class="kop-logo">
                <img src="<?= logoApp(); ?>">
            </div>

            <!-- Tengah -->
            <div class="kop-text">
                <h1><?= namaApp(); ?></h1>
                <h4>( <?= deskApp(); ?> )</h4>
                <h3>
                    <?= !empty(detailUser()->nm_desa)
                        ? 'DESA ' . detailUser()->nm_desa . ' KECAMATAN ' . detailUser()->nm_kec
                        : 'KECAMATAN ' . detailUser()->nm_kec; ?>
                </h3>
                <h6><?= !empty($sekretariat['lp_sekretariat']) ? $sekretariat['lp_sekretariat'] : ''; ?></h6>
            </div>

            <!-- Logo Kanan -->
            <div class="kop-logo">
                <img src="<?= base_url('img/logo-garutkab.jpg') ?>">
            </div>

        </div>

        <!-- JUDUL -->
        <div class="title">
            TANDA TERIMA PEMBAYARAN PBB-P2 (KOLEKTIF)
        </div>

        <!-- INFO -->
        <div class="info">
            <div><b>No Transaksi:</b> <?= $header['tr_faktur'] ?></div>
            <div><b>Tanggal:</b> <?= $tgl_format ?></div>
            <div><b>Nama Penyetor:</b> <?= $header['nama_pelanggan'] ?></div>
            <div><b>Alamat:</b> <?= $header['alamat_pelanggan'] ?></div>
        </div>

        <!-- TABEL -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NOP</th>
                    <th>Nama WP</th>
                    <th>Alamat WP</th>
                    <th>Alamat OP</th>
                    <th>Pajak</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($detail as $d): ?>
                    <tr>
                        <td class="center"><?= $no++ ?></td>
                        <td><?= $d['nop'] ?></td>
                        <td><?= $d['nama_wp'] ?></td>
                        <td><?= $d['alamat_wp'] ?></td>
                        <td><?= $d['alamat_op'] ?></td>
                        <td class="right">Rp <?= number_format($d['pajak'], 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="total">
            Total: Rp <?= number_format($header['tr_totalbersih'], 0, ',', '.') ?>
        </div>

        <!-- TERBILANG -->
        <div class="terbilang">
            Terbilang: <?= ucwords(strtolower($terbilang)) ?>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            Koektor,
            <!-- QR -->
            <div style="margin: 10px 0;">
                <img src="<?= base_url('qr/generate?data=' . urlencode($validasi_url)) ?>" width="100">
            </div>
            <b><?= detailUser()->full_name ?? 'SAPAPADU' ?></b>
        </div>

    </div>

    <script>
        window.print();
    </script>

</body>

</html>