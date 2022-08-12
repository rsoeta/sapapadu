<?php

//CountryModel.php

namespace App\Models;

use CodeIgniter\Model;

class StatusKawinModel extends Model
{

	protected $table = 'tb_status_kawin';

	protected $primaryKey = 'idStatus';

	protected $allowedFields = ['StatusKawin'];
}
