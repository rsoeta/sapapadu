<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class DetailTransModel extends Model
{
    protected $table      = 'pbb_detailtrans21';
    protected $primaryKey = 'id';

    protected $allowedFields = ['dettr_faktur', 'nop', 'pajak', 'ket', 'dettr_subtotal'];

    public function getLunas()
    {
        $builder = $this->db->table('pbb_detailtrans21');
        $builder->select('nama_wp, pbb_dhkp22.nop, alamat_wp, alamat_op, bumi, pajak');
        $builder->join('pbb_dhkp22', 'pbb_dhkp22.nop=pbb_detailtrans21.nop');
        $query = $builder->get();

        return $query;
    }
}
