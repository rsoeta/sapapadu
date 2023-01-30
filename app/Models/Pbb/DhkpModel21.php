<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class DhkpModel21 extends Model
{
    protected $table      = 'pbb_dhkp21';
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
        'ket',
        'dhkp_ajuan',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $skipValidation   = false;


    var $column_order = array('', 'nama_wp', 'nop', 'alamat_wp', 'alamat_op', 'bumi', 'bgn', 'pajak', 'nik_wp', 'nama_ktp', 'dusun', 'rw', 'rt', 'created_at', 'updated_at');

    var $order = array('nop' => 'asc');

    function get_datatables($filter1, $filter2, $filter3, $filter4)
    {
        // desa
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
            $kondisi_filter4 = " AND ket = '$filter4'";
        }

        // search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "(nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
        } else {
            $kondisi_search = "ID != '' $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
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
        $builder = $db->table('pbb_dhkp21');
        $query = $builder->select('*')
            ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp21.ket')
            // ->join('tbl_rt', 'tbl_rt.IdJenKel=pbb_dhkp21.JKAnak')
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
        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp21";
        $db = db_connect();
        $query = $db->query($sQuery)->getRow();

        return $query;
    }

    function jumlah_filter($filter1, $filter2, $filter3, $filter4)
    {
        // desa
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
            $kondisi_filter4 = " AND ket = '$filter4'";
        }

        // kondisi search
        if ($_POST['search']['value']) {
            $search = $_POST['search']['value'];
            $kondisi_search = "AND (nop LIKE '%$search%' OR nama_wp LIKE '%$search%' OR alamat_wp LIKE '%$search%' OR alamat_op LIKE '%$search%' OR bumi LIKE '%$search%' OR bgn LIKE '%$search%' OR pajak LIKE '%$search%' OR nik_wp LIKE '%$search%' OR nama_ktp LIKE '%$search%' OR created_at LIKE '%$search%' OR updated_at LIKE '%$search%') $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
        } else {
            $kondisi_search = "$kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
        }

        $sQuery = "SELECT COUNT(id) as jml FROM pbb_dhkp21 WHERE id != '' $kondisi_search";
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

        return $this->table('pbb_dhkp21')->like('nop', $keyword)
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
            ->orlike('ket', $keyword);
    }

    public function fetchData($limit, $start)
    {
        $query = $this->db->query("SELECT * FROM pbb_dhkp21 a
        WHERE ket = 'Belum bayar'
        ORDER BY a.id DESC
        LIMIT " . $start . ", " . $limit);

        return $query;
    }

    public function getLunas()
    {
        $builder = $this->db->table('pbb_dhkp21');
        $builder->select('*');
        $builder->join('pbb_detailtrans21', 'pbb_detailtrans21.nop = pbb_dhkp21.nop');
        $builder->join('pbb_transaksi21', 'pbb_transaksi21.tr_faktur = pbb_detailtrans21.dettr_faktur');
        $builder->where('pbb_dhkp21.ket', '0');
        //     ->get()
        // $builder->get();
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getJoin()
    {
        $builder = $this->db->table('pbb_dhkp21');
        // $builder->select('*');
        $builder->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp21.ket');
        $builder->join('pbb_ajuan', 'pbb_ajuan.pa_id=pbb_dhkp21.dhkp_ajuan');
        $builder->orderBy('nama_wp', 'asc');

        $query = $builder->get();
        return $query;
    }

    public function getBiodata($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            $builder = $this->db->table('pbb_dhkp21');
            $builder->select('*');
            $builder->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp21.ket');
            $builder->join('pbb_ajuan', 'pbb_ajuan.pa_id=pbb_dhkp21.dhkp_ajuan');
            $builder->orderBy('nama_wp', 'asc');

            $query = $builder->getWhere(['id' => $id]);
            return $query;

            // 32.07.040.011.156-2468.0

            // return $this->db->table('pbb_dhkp21')->where(['id' => $id]);
        }
    }

    public function dataExport($filter2, $filter3, $filter4, $filter5)
    {
        $builder = $this->db->table('pbb_dhkp21');
        $builder->select('nop, nama_wp, alamat_wp, alamat_op, bumi, bgn, pajak, dusun, rw, rt, sta_keterangan');
        $builder->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp21.ket');
        if ($filter2 !== "") {
            $builder->where('dusun', $filter2);
        }
        if ($filter3 !== "") {
            $builder->where('rw', $filter3);
        }
        if ($filter4 !== "") {
            $builder->where('rt', $filter4);
        }
        if ($filter5 !== "") {
            $builder->where('ket', $filter5);
        }
        $builder->orderBy('nop', 'asc');
        $query = $builder->get();

        return $query;
        // return $this->table('pbb_dhkp21')
        //     ->select('nop, nama_wp, alamat_wp, alamat_op, bumi, bgn, pajak, dusun, rw, rt, sta_keterangan')
        // ->join('pbb_stasppt', 'pbb_stasppt.sta_id=pbb_dhkp21.ket')
        // ->where('dusun =', $filter2)
        // ->orWhere('rw =', $filter3)
        // ->orWhere('rt =', $filter4)
        // ->orWhere('ket =', $filter5)
        // ->orderBy('nop', 'asc')
        // ->get();
    }
}
