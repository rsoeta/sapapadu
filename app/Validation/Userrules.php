<?php

namespace App\Validation;

use App\Models\Pbb\AuthModel;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new AuthModel();
        $user = $model->where('pu_email', $data['email'])->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['pu_password']);
    }
}
