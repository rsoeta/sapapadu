<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class TempModel extends Model
{
    protected $table      = 'pbb_temptrans21';
    protected $primaryKey = 'id';

    protected $allowedFields = ['dettr_faktur', 'nop', 'pajak', 'ket', 'dettr_subtotal'];
}
