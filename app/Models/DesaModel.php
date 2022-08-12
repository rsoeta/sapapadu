<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class DesaModel extends Model
{

	protected $table = 'tb_villages';

	protected $primaryKey = 'id';

	protected $allowedFields = ['name', 'province_id', 'regency_id', 'district_id'];
}
