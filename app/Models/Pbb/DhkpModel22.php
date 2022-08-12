<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class DhkpModel22 extends Model
{
    protected $table      = 'pbb_dhkp22';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nop',
        'nama_wp',
        'alamat_wp',
        'alamat_op',
        'bumi',
        'bgn',
        'pajak',
        'nik_wp',
        'nama_ktp',
        'pd_prov',
        'pd_kab',
        'pd_kec',
        'pd_desa',
        'dusun',
        'rw',
        'rt',
        'pd_ket',
        'dhkp_ajuan',
        'created_at',
        'updated_at',
        'pd_creator',
        'pd_updater'
    ];

    protected $useTimestamps = true;
    protected $skipValidation   = false;


    var $column_order = array('', 'nama_wp', 'nop', 'alamat_wp', 'alamat_op', 'bumi', 'pajak', 'nama_ktp', 'dusun', 'rw', 'rt', 'pd_ket');
    var $column_order1 = array('', 'nama_wp', 'nop', 'alamat_wp', 'alamat_op', 'bumi', 'pajak', 'nama_ktp', 'dusun', 'rw', 'rt');
    var $column_order0 = array('', 'nama_wp', 'nop', 'alamat_wp', 'alamat_op', 'bumi', 'pajak', 'nama_ktp', 'dusun', 'rw', 'rt');

    var $order = array('nop' => 'asc');
    var $order1 = array('nama_wp' => 'asc');
    var $order0 = array('updated_at' => 'asc');

    function get_datatables($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }
        // status
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }
        // keterangan
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "(nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "ID != '' $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        // order
        if (isset($_POST['order'])) {
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];
        } else if ($this->order) {
            $order = $this->order;
            $result_order = key($order);
            $result_dir = $order[key($order)];
        }

        if ($_POST['length'] != -1);
        $db = db_connect();
        $builder = $db->table('pbb_dhkp22');
        $query = $builder->select('*')
            ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp22.pd_ket')
            // ->join('tbl_rt', 'tbl_rt.IdJenKel=pbb_dhkp22.JKAnak')
            // ->join('pekerjaan_kondisi_pekerjaan', 'pekerjaan_kondisi_pekerjaan.IDKondisi=individu_data.KondisiPekerjaan')
            // ->join('pendidikan_pend_tinggi', 'pendidikan_pend_tinggi.IDPendidikan=individu_data.PendTertinggi')
            // ->join('ket_verivali', 'ket_verivali.id_ketvv=individu_data.ket_verivali')
            ->where($kondisi_search)
            ->orderBy($result_order, $result_dir)
            ->limit($_POST['length'], $_POST['start'])
            ->get();

        return $query->getResult();
    }

    function jumlah_semua()
    {
        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlah_filter($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }

        // operator
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }

        // rw
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // kondisi search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "AND (nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "$kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE id != '' $kondisi_search";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function get_datatables0($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }
        // status
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }
        // keterangan
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "(pbb_dhkp22.nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "pbb_dhkp22.id != '' $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        // order
        if (isset($_POST['order'])) {
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];
        } else if ($this->order0) {
            $order0 = $this->order0;
            $result_order = key($order0);
            $result_dir = $order0[key($order0)];
        }

        if ($_POST['length'] != -1);
        $db = db_connect();
        $builder = $db->table('pbb_dhkp22');
        $query = $builder->select('pbb_dhkp22.id, nama_wp, pbb_dhkp22.nop, alamat_wp, alamat_op, bumi, pajak, nama_ktp, dusun, rw, rt, updated_at')
            ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp22.pd_ket')
            // ->join('pbb_detailtrans21', 'pbb_detailtrans21.nop=pbb_dhkp22.nop')
            // ->join('pekerjaan_kondisi_pekerjaan', 'pekerjaan_kondisi_pekerjaan.IDKondisi=individu_data.KondisiPekerjaan')
            // ->join('pendidikan_pend_tinggi', 'pendidikan_pend_tinggi.IDPendidikan=individu_data.PendTertinggi')
            // ->join('ket_verivali', 'ket_verivali.id_ketvv=individu_data.ket_verivali')
            ->where($kondisi_search)
            ->orderBy($result_order, $result_dir)
            ->limit($_POST['length'], $_POST['start'])
            ->get();

        return $query->getResult();
    }

    function jumlah_semua0()
    {
        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE pd_ket = 0";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlah_filter0($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }

        // operator
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }

        // rw
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // kondisi search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "AND (pbb_dhkp22.nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "$kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE id != '' $kondisi_search";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function get_datatables1($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }
        // status
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }
        // keterangan
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "(nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "ID != '' $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        // order
        if (isset($_POST['order'])) {
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];
        } else if ($this->order1) {
            $order1 = $this->order1;
            $result_order = key($order1);
            $result_dir = $order1[key($order1)];
        }

        if ($_POST['length'] != -1);
        $db = db_connect();
        $builder = $db->table('pbb_dhkp22');
        $query = $builder->select('*')
            ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp22.pd_ket')
            ->where($kondisi_search)
            ->orderBy($result_order, $result_dir)
            ->limit($_POST['length'], $_POST['start'])
            ->get();

        return $query->getResult();
    }


    function jumlah_semua1()
    {
        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE pd_ket = 1";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlah_filter1($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }

        // operator
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }

        // rw
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket = '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // kondisi search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "AND (nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "$kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE id != '' $kondisi_search";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function get_datatables2($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }
        // status
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }
        // keterangan
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket >= '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "(nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "ID != '' $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        // order
        if (isset($_POST['order'])) {
            $result_order = $this->column_order[$_POST['order']['0']['column']];
            $result_dir = $_POST['order']['0']['dir'];
        } else if ($this->order1) {
            $order1 = $this->order1;
            $result_order = key($order1);
            $result_dir = $order1[key($order1)];
        }

        if ($_POST['length'] != -1);
        $db = db_connect();
        $builder = $db->table('pbb_dhkp22');
        $query = $builder->select('*')
            ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp22.pd_ket')
            ->where($kondisi_search)
            ->orderBy($result_order, $result_dir)
            ->limit($_POST['length'], $_POST['start'])
            ->get();

        return $query->getResult();
    }


    function jumlah_semua2()
    {
        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE pd_ket >= 2";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlah_filter2($filter0, $filter1, $filter2, $filter3, $filter4, $filter5)
    {
        // desa
        if ($filter0 == "") {
            $kondisi_filter0 = "";
        } else {
            $kondisi_filter0 = "AND pd_desa = '$filter0'";
        }

        // dusun
        if ($filter1 == "") {
            $kondisi_filter1 = "";
        } else {
            $kondisi_filter1 = " AND dusun = '$filter1'";
        }

        // rw
        if ($filter2 == "") {
            $kondisi_filter2 = "";
        } else {
            $kondisi_filter2 = " AND rw = '$filter2'";
        }

        // operator
        if ($filter3 == "") {
            $kondisi_filter3 = "";
        } else {
            $kondisi_filter3 = " AND rt = '$filter3'";
        }

        // rw
        if ($filter4 == "") {
            $kondisi_filter4 = "";
        } else {
            $kondisi_filter4 = " AND pd_ket >= '$filter4'";
        }
        // tahun
        if ($filter5 == "") {
            $kondisi_filter5 = "";
        } else {
            $kondisi_filter5 = " AND YEAR(created_at) = '$filter5'";
        }

        // kondisi search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "AND (nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        } else {
            $kondisi_search = "$kondisi_filter0 $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4 $kondisi_filter5";
        }

        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp22 WHERE id != '' $kondisi_search";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    public function search($keyword)
    {
        // if ($tombolCari == false) {
        //     return $this->findAll();
        // }
        // return $this->where(['id' => $id])->first();

        return $this->table('pbb_dhkp22')->like('nop', $keyword)
            ->orlike('nama_wp', $keyword)
            ->orlike('alamat_wp', $keyword)
            ->orlike('alamat_op', $keyword)
            ->orlike('bumi', $keyword)
            ->orlike('bgn', $keyword)
            ->orlike('pajak', $keyword)
            ->orlike('nik_wp', $keyword)
            ->orlike('nama_ktp', $keyword)
            ->orlike('dusun', $keyword)
            ->orlike('rw', $keyword)
            ->orlike('rt', $keyword)
            ->orlike('pd_ket', $keyword);
    }

    public function fetchData($limit, $start)
    {
        $query = $this->db->query("SELECT * FROM pbb_dhkp22 a
        WHERE pd_ket = 'Belum bayar'
        ORDER BY a.id DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
    }

    public function getLunas()
    {
        $builder = $this->db->table('pbb_dhkp22');
        $builder->select('*');
        $builder->join('pbb_detailtrans21', 'pbb_detailtrans21.nop = pbb_dhkp22.nop');
        $builder->join('pbb_transaksi21', 'pbb_transaksi21.tr_faktur = pbb_detailtrans21.dettr_faktur');
        $builder->where('pbb_dhkp22.pd_ket', '0');
        //     ->get()
        // $builder->get();
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function jumlah_total()
    {
        $sQuery = "SELECT SUM(pajak) as jumlah_total FROM pbb_dhkp22";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlahLunas()
    {
        $sQuery = "SELECT COUNT(id) as jumlahLunas FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket=0";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    public function jumlahTotalLunas()
    {
        $sQuery = "SELECT SUM(pajak) as jumlahTotalLunas FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket=0";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlahBelumLunas()
    {
        $sQuery = "SELECT COUNT(id) as jumlahBelumLunas FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket=1";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    public function jumlahTotalBelumLunas()
    {
        $sQuery = "SELECT SUM(pajak) as jumlahTotalBelumLunas FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket=1";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlahBermasalah()
    {
        $sQuery = "SELECT COUNT(id) as jumlahBermasalah FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket>1";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    public function jumlahTotalBermasalah()
    {
        $sQuery = "SELECT SUM(pajak) as jumlahTotalBermasalah FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket>1";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    public function getDataRekDes()
    {
        $builder = $this->db->table('pbb_dhkp22');
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket>1) AS pajak2', false);
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_ket=0) AS pajak0', false);
        $builder->distinct();
        $query = $builder->get();
        return $query;
    }

    public function getDataRekDus()
    {
        $builder = $this->db->table('pbb_dhkp22');
        $builder->select('dusun');
        $builder->join('tbl_dusun', 'tbl_dusun.no_dusun = pbb_dhkp22.dusun');
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.dusun=tbl_dusun.no_dusun) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.dusun=tbl_dusun.no_dusun && pbb_dhkp22.pd_ket=0) AS pajak0', false);
        $builder->orderBy('dusun', 'asc');
        $builder->distinct();
        $query = $builder->get();
        return $query;
    }

    public function getDataRekRw()
    {
        $builder = $this->db->table('pbb_dhkp22');
        $builder->select('rw');
        $builder->join('tb_villages', 'tb_villages.id = pbb_dhkp22.pd_desa');
        $builder->join('tb_rw', 'tb_rw.no_rw = pbb_dhkp22.rw');
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_desa=tb_villages.id && pbb_dhkp22.rw=tb_rw.no_rw) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.pd_desa=tb_villages.id && pbb_dhkp22.rw=tb_rw.no_rw && pbb_dhkp22.pd_ket=0) AS pajak0', false);
        $builder->orderBy('rw', 'asc');
        $builder->distinct();
        $query = $builder->get();
        return $query;
    }

    public function getDataRekRt()
    {
        $builder = $this->db->table('pbb_dhkp22');
        $builder->select('dusun, rw, rt');
        $builder->join('tbl_dusun', 'tbl_dusun.no_dusun = pbb_dhkp22.dusun');
        $builder->join('tb_rw', 'tb_rw.no_rw = pbb_dhkp22.rw');
        $builder->join('tb_rt', 'tb_rt.no_rt = pbb_dhkp22.rt');
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.rw=tb_rw.no_rw && pbb_dhkp22.rt=tb_rt.no_rt) AS pajak1', false);
        $builder->select('(SELECT SUM(pbb_dhkp22.pajak) FROM pbb_dhkp22 WHERE pbb_dhkp22.rw=tb_rw.no_rw && pbb_dhkp22.rt=tb_rt.no_rt && pbb_dhkp22.pd_ket=0) AS pajak0', false);
        $builder->groupBy(['dusun', 'rw', 'rt']);
        $query = $builder->get();
        return $query;
    }
}
