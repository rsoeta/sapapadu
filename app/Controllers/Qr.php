<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Qr extends BaseController
{
    public function generate()
    {
        $data = $this->request->getGet('data');

        if (!$data) {
            return;
        }

        // 🔥 API QR yang stabil
        $url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($data);

        // ambil image
        $image = @file_get_contents($url);

        if (!$image) {
            return "QR gagal dimuat";
        }

        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setBody($image);
    }
}
