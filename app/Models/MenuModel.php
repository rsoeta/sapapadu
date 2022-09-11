<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

	protected $table = 'tb_menu';

	protected $primaryKey = 'tm_id';

	protected $allowedFields = ['tm_sort', 'tm_nama', 'tm_class', 'tm_url', 'tm_icon', 'tm_parent_id', 'tm_status', 'tm_grup_akses'];

	public function getMenu()
	{
		$builder = $this->db->table($this->table);
		$builder->orderBy('tm_sort', 'asc');
		return $builder->get()->getResultArray();
	}
}
