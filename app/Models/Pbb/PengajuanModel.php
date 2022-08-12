<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table      = 'pbb_ajuan';
    protected $primaryKey = 'pa_id';

    protected $allowedFields = ['pa_keterangan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
}
