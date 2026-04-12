<?php

if (!function_exists('struk_token')) {
    function struk_token($faktur)
    {
        $secret = getenv('app.strukKey') ?: 'SAPAPADU_SECRET_KEY';

        // 🔥 WAJIB: bersihkan dari #
        $faktur_clean = str_replace('#', '', $faktur);

        return hash_hmac('sha256', $faktur_clean, $secret);
    }
}

if (!function_exists('struk_url')) {
    function struk_url($faktur)
    {
        // 🔥 konsisten: bersihkan dulu
        $faktur_clean = str_replace('#', '', $faktur);

        $token = struk_token($faktur_clean);

        return base_url("print/struk/{$faktur_clean}/{$token}");
    }
}

if (!function_exists('validasi_url')) {
    function validasi_url($faktur)
    {
        // 🔥 konsisten juga di validasi
        $faktur_clean = str_replace('#', '', $faktur);

        $token = struk_token($faktur_clean);

        return base_url("validasi/{$faktur_clean}/{$token}");
    }
}
