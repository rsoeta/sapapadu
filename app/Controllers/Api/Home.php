<?php

namespace App\Controllers\Api;

use App\Models\Pbb\DhkpModel22;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
    use ResponseTrait;

    public function show($id = null)
    {
        $model = new DhkpModel22();
        $data = $model->getBiodata($id)->getRowArray();

        // var_dump($data);
        // die;
        return $this->respond($data);
    }
}
