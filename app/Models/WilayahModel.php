<?php

//CountryModel.php
namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class WilayahModel extends Model
{

	protected $table = 'tb_villages';
	protected $primaryKey = 'id';
	protected $allowedFields = ['name'];
	var $column_order = array('', '', 'namaProv', 'namaKab', 'namaKec', 'namaDesa');

	var $order = array('tb_villages.province_id' => 'asc');

	function get_datatables($filter1, $filter2, $filter3, $filter4)
	{
		// fil$filter1
		if ($filter1 == "") {
			$kondisi_filter1 = "";
		} else {
			$kondisi_filter1 = " AND tb_villages.province_id = '$filter1'";
		}

		// status
		if ($filter2 == "") {
			$kondisi_filter2 = "";
		} else {
			$kondisi_filter2 = " AND tb_villages.regency_id = '$filter2'";
		}
		// rw
		if ($filter3 == "") {
			$kondisi_filter3 = "";
		} else {
			$kondisi_filter3 = " AND tb_villages.district_id = '$filter3'";
		}
		// rt
		if ($filter4 == "") {
			$kondisi_filter4 = "";
		} else {
			$kondisi_filter4 = " AND tb_villages.id = '$filter4'";
		}

		// search
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$kondisi_search = "(namaProv LIKE '%$search%' OR namaKab LIKE '%$search%' OR namaKec LIKE '%$search%' OR namaDesa LIKE '%$search%') $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
		} else {
			$kondisi_search = "tb_villages.id != '' $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
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
		$builder = $db->table('tb_villages');
		$query = $builder->select('tb_villages.id as idDesa, tb_provinces.name as namaProv, tb_regencies.name as namaKab, tb_districts.name as namaKec, tb_villages.name as namaDesa')
			->join('tb_districts', 'tb_districts.id=tb_villages.district_id')
			->join('tb_regencies', 'tb_regencies.id=tb_districts.regency_id')
			->join('tb_provinces', 'tb_provinces.id=tb_regencies.province_id')
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
		$sQuery = "SELECT COUNT(id) as jml FROM tb_villages";
		$db = db_connect();
		$query = $db->query($sQuery)->getRow();

		return $query;
	}

	function jumlah_filter($filter1, $filter2, $filter3, $filter4)
	{
		// fil$filter1
		if ($filter1 == "") {
			$kondisi_filter1 = "";
		} else {
			$kondisi_filter1 = " AND tb_villages.province_id = '$filter1'";
		}

		// status
		if ($filter2 == "") {
			$kondisi_filter2 = "";
		} else {
			$kondisi_filter2 = " AND tb_villages.regency_id = '$filter2'";
		}
		// rw
		if ($filter3 == "") {
			$kondisi_filter3 = "";
		} else {
			$kondisi_filter3 = " AND tb_villages.district_id = '$filter3'";
		}
		// rt
		if ($filter4 == "") {
			$kondisi_filter4 = "";
		} else {
			$kondisi_filter4 = " AND tb_villages.id = '$filter4'";
		}

		// kondisi search
		if ($_POST['search']['value']) {
			$search = $_POST['search']['value'];
			$kondisi_search = "AND (namaProv LIKE '%$search%' OR namaKab LIKE '%$search%' OR namaKec LIKE '%$search%' OR namaDesa LIKE '%$search%') $kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
		} else {
			$kondisi_search = "$kondisi_filter1 $kondisi_filter2 $kondisi_filter3 $kondisi_filter4";
		}

		$sQuery = "SELECT COUNT(id) as jml FROM tb_villages WHERE id != '' $kondisi_search";
		$db = db_connect();
		$query = $db->query($sQuery)->getRow();

		return $query;
	}

	public function getProv()
	{
		$builder = $this->db->table('tb_provinces');
		$builder->select('*');
		$builder->orderBy('name', 'asc');
		$query = $builder->get();

		return $query->getResultArray();
	}

	public function getKab()
	{
		$builder = $this->db->table('tb_regencies');
		$builder->select('*');
		$builder->orderBy('name', 'asc');
		$query = $builder->get();

		// var_dump($query->getResultArray());
		return $query->getResultArray();
	}

	public function getKec()
	{
		$builder = $this->db->table('tb_districts');
		$builder->select('id, name, regency_id');
		$builder->join('pbb_users', 'pbb_users.pu_kode_kab=tb_districts.regency_id');
		$builder->distinct();
		$builder->orderBy('name', 'asc');
		$query = $builder->get();

		// var_dump($query->getResultArray());
		return $query->getResultArray();
	}

	public function getDataDesa()
	{
		$builder = $this->db->table('tb_villages');
		$builder->select('*');
		$builder->orderBy('name', 'asc');
		$query = $builder->get();

		return $query->getResultArray();
	}

	public function getDesa($district_id)
	{
		$builder = $this->db->table('tb_villages');
		$builder->select('id, name');
		$builder->where('district_id', $district_id);
		$builder->distinct();
		$builder->orderBy('name', 'asc');
		$query = $builder->get();

		return $query->getResultArray();
	}

	public function getDusun()
	{
		$builder = $this->db->table('tb_dusun');
		$builder->select('*');

		$query = $builder->get();

		// print_r($query);
		return $query->getResultArray();
	}

	public function getDataRW()
	{
		$builder = $this->db->table('dtks_data_clean');
		$builder->select('no_rw');
		$builder->distinct();
		$builder->orderBy('no_rw', 'asc');

		$query = $builder->get();

		return $query;
	}

	public function getDataRT()
	{
		$builder = $this->db->table('dtks_data_clean');
		$builder->select('no_rt');
		$builder->distinct();
		$builder->orderBy('no_rt', 'asc');

		$query = $builder->get();

		return $query;
	}

	public function getDataRtRwDusun()
	{
		$kode_desa = detailUser()->pu_kode_desa;
		$builder = $this->db->table('tb_rt');
		$builder->select('*');
		$builder->where('kode_desa', $kode_desa);
		$builder->orderBy('no_dusun', 'asc');
		$query = $builder->get();
		return $query->getResultArray();
	}

	public function getAjaxSearch()
	{
		$kecamatan = profilAdmin()->pu_kode_kec;

		$builder = $this->db->table('tb_villages');
		$builder->select('tb_villages.id as kode_desa, tb_villages.name as nama_desa, tb_districts.id as kode_kec, tb_districts.name as nama_kec, tb_regencies.id as kode_kab, tb_regencies.name as nama_kab, tb_provinces.id as kode_prov, tb_provinces.name as nama_prov');
		$builder->join('tb_districts', 'tb_districts.id=tb_villages.district_id');
		$builder->join('tb_regencies', 'tb_regencies.id=tb_villages.regency_id');
		$builder->join('tb_provinces', 'tb_provinces.id=tb_villages.province_id');
		$builder->where('tb_districts.id', $kecamatan);

		$query = $builder->get();

		return $query;
	}
}
