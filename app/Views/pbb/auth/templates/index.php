<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= namaApp() . ' | ' . $title; ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawsom-all.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('favicon.ico'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('favicon.ico'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('favicon.ico'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon.ico'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('favicon.ico'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon.ico'); ?>">
    <link rel="manifest" href="<?= base_url('pbb_ico/manifest.json'); ?>">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">


    <style>
        a {
            text-decoration: none
        }
    </style>

</head>

<body>

    <?= $this->renderSection('content'); ?>

</body>

<script src="<?= base_url('assets/js/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>


</html>