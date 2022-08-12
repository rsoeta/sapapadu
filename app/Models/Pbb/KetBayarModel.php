<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class KetBayarModel extends Model
{
    protected $table      = 'pbb_stasppt';
    protected $primaryKey = 'sta_id';

    protected $allowedFields = ['sta_keterangan','sta_class'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

}
