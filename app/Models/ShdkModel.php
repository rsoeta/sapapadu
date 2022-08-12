<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class ShdkModel extends Model
{

	protected $table = 'tb_shdk';

	protected $primaryKey = 'id';

	protected $allowedFields = ['jenis_shdk'];
}
