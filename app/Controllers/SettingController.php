<?php

namespace App\Controllers;

use App\Models\AppConfigModel;

class SettingController extends BaseController
{
    public function fonnte()
    {
        $model = new AppConfigModel();

        return view('settings/fonnte', [
            'title' => 'Pengaturan Fonnte',
            'token' => $model->getValue('fonnte_token')
        ]);
    }

    public function saveFonnte()
    {
        $model = new AppConfigModel();
        $token = $this->request->getPost('token');

        if (!$token) {
            return redirect()->back()->with('error', 'Token tidak boleh kosong');
        }

        $model->setValue('fonnte_token', $token);

        return redirect()->back()->with('success', 'Token berhasil diperbarui');
    }
}
