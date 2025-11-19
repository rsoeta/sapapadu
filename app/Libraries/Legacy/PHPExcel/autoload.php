<?php

// Autoload untuk library PHPExcel lama (non-PSR4)
spl_autoload_register(function ($class) {
    $base = APPPATH . 'Libraries/Legacy/PHPExcel/';

    $file = $base . str_replace('_', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
