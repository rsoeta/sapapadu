<?php

namespace App\Models;

use CodeIgniter\Model;

class AppConfigModel extends Model
{
    protected $table = 'app_config';
    protected $primaryKey = 'id';
    protected $allowedFields = ['config_key', 'config_value', 'is_secret'];

    public function getValue($key)
    {
        $row = $this->where('config_key', $key)->first();
        return $row ? $row['config_value'] : null;
    }

    public function setValue($key, $value)
    {
        $existing = $this->where('config_key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], [
                'config_value' => $value
            ]);
        }

        return $this->insert([
            'config_key' => $key,
            'config_value' => $value
        ]);
    }
}
