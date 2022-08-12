<?php

namespace App\Models;

use CodeIgniter\Model;

class RwModel extends Model
{

	protected $table = 'tb_rw';

	protected $primaryKey = 'id';

	protected $allowedFields = ['kode_desa', 'no_dusun', 'no_rw', 'nama_ketua_rw'];

	public function noRw()
	{
		// echo 'test';
		$role = detailUser()['pu_role_id'];
		$desa = detailUser()['pu_kode_desa'];
		$level = detailUser()['pu_level'];

		if (($level == null && $role == 1) || ($level != null && $role == 1)) {
			$builder = $this->db->table('tb_rw');
			$builder->select('no_rw, nama_ketua_rw');
			$builder->distinct();
			$query = $builder->get();
		} elseif (($level == null && $role == 2) || ($level != null && $role == 2)) {
			$builder = $this->db->table('tb_rw');
			$builder->select('no_rw, nama_ketua_rw');
			$builder->distinct();
			$query = $builder->get();
		} elseif (($role == 3 && $level == null) || ($role == 3 && $level != null)) {
			$builder = $this->db->table('tb_rw');
			$builder->where('kode_desa', $desa);
			$builder->select('no_rw, nama_ketua_rw')->distinct();
			$query = $builder->get();
		} elseif ($role == 4 && $level !== null) {
			$builder = $this->db->table('tb_rw');
			$builder->where('kode_desa', $desa);
			$builder->where('no_rw', $level);
			$builder->select('no_rw, nama_ketua_rw')->distinct();
			$query = $builder->get();
		} else {
			$builder = $this->db->table('tb_rw');
			$builder->where('kode_desa', $desa);
			$builder->where('no_rw', '000');
			$builder->select('no_rw, nama_ketua_rw')->distinct();
			$query = $builder->get();
		}

		return $query->getResultArray();
	}

	function getDataRw($desa, $dusun)
	{
		$builder = $this->db->table('tb_rw');
		$builder->where('kode_desa', $desa);
		$builder->where('no_dusun', $dusun);
		$builder->select('no_rw, nama_ketua_rw')->distinct();
		$query = $builder->get();

		return $query->getResultArray();
	}
}
