<?php

namespace App\Models\Pbb;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ModelPbbTerhutang extends Model
{

    protected $table = "pbb_dhkp22";
    protected $column_order = array(null, 'nop', 'nama_wp', 'alamat_op', 'pajak', 'pd_ket', 'nama_dusun', null, null);
    protected $column_search = array('nop', 'nama_wp', 'nama_dusun');
    protected $order = array('nop' => 'asc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
    }

    private function _get_datatables_query($keywordnop)
    {
        $pd_desa = detailUser()->pu_kode_desa;
        if (strlen($keywordnop) == 0) {
            $this->dt = $this->db->table($this->table)
                // ->join('tb_dusun', 'tb_dusun.td_kode_dusun=pbb_dhkp22.dusun')
                ->where('pd_desa', $pd_desa);
        } else {
            $this->dt = $this->db->table($this->table)
                // ->join('tb_dusun', 'tb_dusun.td_kode_dusun=pbb_dhkp22.dusun')
                ->where('pd_desa', $pd_desa)
                ->like('nop', $keywordnop)
                ->orLike('nama_wp', $keywordnop);
        }
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables($keywordnop)
    {
        $this->_get_datatables_query($keywordnop);
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered($keywordnop)
    {
        $this->_get_datatables_query($keywordnop);
        return $this->dt->countAllResults();
    }

    public function count_all($keywordnop)
    {
        $pd_desa = detailUser()->pu_kode_desa;
        if (strlen($keywordnop) == 0) {
            $tbl_storage = $this->db->table($this->table)
                // ->join('tb_dusun', 'tb_dusun.td_kode_dusun=pbb_dhkp22.dusun')
                ->where('pd_desa', $pd_desa);
            // $tbl_storage = $this->db->select('*')->from('pbb_dhkp22')
            //     ->join('tb_dusun', 'tb_dusun.td_kode_dusun = pbb_dhkp22.dusun')
            //     ->join('tbl_rw', 'tbl_rw.no_rw = pbb_dhkp22.rw')
            //     ->join('tbl_rt', 'tbl_rt.no_rt = pbb_dhkp22.rt')->get();
        } else {
            $tbl_storage = $this->db->table($this->table)
                // ->join('tb_dusun', 'tb_dusun.td_kode_dusun=pbb_dhkp22.dusun')
                ->where('pd_desa', $pd_desa)
                ->like('nop', $keywordnop)
                ->orLike('nama_wp', $keywordnop);
        }

        return $tbl_storage->countAllResults();
    }
}
