<!DOCTYPE html>
<html>

<head>
    <title>Struk Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            text-align: center;
            padding: 40px;
        }

        .card {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 60px;
        }

        h2 {
            margin-top: 10px;
        }

        p {
            color: #555;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #2E7D32;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="card">
        <div class="icon">❌</div>
        <h2>Data Tidak Ditemukan</h2>
        <p>Struk pembayaran tidak tersedia atau sudah tidak valid.</p>

        <a href="<?= base_url(); ?>" class="btn">Kembali</a>
    </div>

</body>

</html>