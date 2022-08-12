<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{

	protected $table = 'tbl_pekerjaan';

	protected $primaryKey = 'idPekerjaan';

	protected $allowedFields = ['JenisPekerjaan'];
}
