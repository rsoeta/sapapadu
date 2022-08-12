<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class GenModel extends Model
{

	protected $table = 'tb_shdk';

	protected $primaryKey = 'id';

	protected $allowedFields = ['jenis_shdk'];

	public function getDataJenkel()
	{
		$builder = $this->db->table('tbl_jenkel');
		$query = $builder->get()->getResultArray();

		return $query;
	}

	public function getDataStatusKawin()
	{
		$builder = $this->db->table('tb_status_kawin');
		$query = $builder->get()->getResultArray();

		return $query;
	}

	public function getDataStatusVaksin()
	{
		$builder = $this->db->table('dtks_vaksin_status');
		$sQuery = $builder->get();

		return $sQuery->getResultArray();
	}

	public function getStatusRole()
	{
		$builder = $this->db->table('tb_roles');
		$query = $builder->get()->getResultArray();

		return $query;
	}
}
