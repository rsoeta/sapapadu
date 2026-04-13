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
            display: block;
            /* 🔥 jangan flex di parent */
        }

        /* SCREEN ONLY */
        .kop-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .kop-logo:first-child {
            text-align: left;
        }

        .kop-logo:last-child {
            text-align: right;
        }

        /* DEFAULT (SCREEN) */
        .kop-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .kop-table {
            display: none;
        }

        .kop-wrapper {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        /* 🔥 JUDUL */

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

        table tbody tr:nth-child(even) {
            background: #fafafa;
        }

        @media print {

            body {
                margin: 10px;
            }

            /* ❌ MATIKAN FLEX TOTAL */
            .kop-flex {
                display: none !important;
            }

            /* 🔥 AKTIFKAN TABLE */
            .kop-table {
                text-align: center;
                flex: 1;
                font-family: "Bookman Old Style", serif;

                display: table !important;
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
                margin-bottom: 10px;
            }

            .kop-table td {
                vertical-align: middle;
                padding: 6px;
                border: none !important;
            }

            /* PROPORSI */
            .kop-kiri {
                width: 20%;
                text-align: left;
            }

            .kop-tengah {
                width: 60%;
                text-align: center;
            }

            .kop-kanan {
                width: 20%;
                text-align: right;
            }

            /* LOGO */
            .kop-kiri img,
            .kop-kanan img {
                width: 60px;
                display: block;
            }

            /* TEXT */
            .kop-title {
                font-size: 28px;
                letter-spacing: 10px;
                margin: 0;
                font-weight: bold;
            }

            .kop-sub {
                font-size: 11px;
                margin: 2px 0;
                font-weight: normal;
            }

            .kop-desa {
                margin: 2px 0;
                font-size: 12px;
                font-weight: bold;
            }

            .kop-wrapper {
                border-bottom: 4px double #000 !important;
                padding-bottom: 8px;
                margin-bottom: 12px;
            }

            /* FOOTER */
            .footer {
                text-align: right !important;
            }

            * {
                -webkit-print-color-adjust: exact;
            }

            table th,
            table td {
                padding: 6px 8px !important;
                /* 🔥 tambah ruang */
                line-height: 1.4 !important;
                /* 🔥 biar tidak naik */
                vertical-align: middle !important;
            }

            table {
                display: table !important;
                overflow: visible !important;
                white-space: normal !important;
            }

            table {
                border-collapse: collapse;
            }

            table th {
                padding: 7px 8px !important;
            }
        }

        /* MOBILE FIX */
        @media (max-width: 768px) {

            body {
                margin: 10px;
            }

            .container {
                max-width: 100%;
            }


            .kop {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .kop-logo {
                margin-bottom: 10px;
            }

            .footer {
                text-align: center;
            }

            .kop-text h1 {
                font-size: 18px;
                letter-spacing: 3px;
            }

            /* 🔥 TABLE SCROLL */
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            table th,
            table td {
                font-size: 11px;
                padding: 4px;
            }

        }

        @media (min-width: 1024px) {

            .container {
                max-width: 1000px;
            }

            table th,
            table td {
                padding: 8px;
            }

        }
    </style>
</head>

<body>

    <div class="container">

        <!-- 🔥 KOP BARU -->

        <div class="kop-wrapper">
            <div class="kop">

                <!-- SCREEN MODE -->
                <div class="kop-flex">
                    <div class="kop-logo kiri">
                        <img src="<?= logoApp(); ?>">
                    </div>

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

                    <div class="kop-logo kanan">
                        <img src="<?= base_url('img/logo-garutkab.jpg') ?>">
                    </div>
                </div>

                <!-- PRINT MODE -->
                <table class="kop-table">
                    <tr>
                        <td class="kop-kiri">
                            <img src="<?= logoApp(); ?>">
                        </td>

                        <td class="kop-tengah">
                            <div class="kop-title"><?= namaApp(); ?></div>
                            <div class="kop-sub">( <?= deskApp(); ?> )</div>
                            <div class="kop-desa">
                                DESA <?= detailUser()->nm_desa ?>
                                KECAMATAN <?= detailUser()->nm_kec ?>
                            </div>
                        </td>

                        <td class="kop-kanan">
                            <img src="<?= base_url('img/logo-garutkab.jpg') ?>">
                        </td>
                    </tr>
                </table>

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