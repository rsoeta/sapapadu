<?php

if (!function_exists('penyebut')) {
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        $temp = "";

        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } elseif ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " Belas";
        } elseif ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
        } elseif ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } elseif ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
        } elseif ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } elseif ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
        } elseif ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
        } elseif ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " Miliar" . penyebut(fmod($nilai, 1000000000));
        } else {
            $temp = "Angka terlalu besar";
        }

        return $temp;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($nilai, $style = 'normal')
    {
        $hasil = trim(penyebut($nilai)) . " Rupiah";

        switch ($style) {
            case 'upper':
                return strtoupper($hasil);
            case 'lower':
                return strtolower($hasil);
            case 'ucwords':
                return ucwords($hasil);
            default:
                return $hasil;
        }
    }
}
