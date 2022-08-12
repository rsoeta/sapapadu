<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'pbb_users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'email', 'password', 'status', 'foto'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    // protected $skipValidation     = false;

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (!isset($data['data']['password']))
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->db->table('pbb_users')
            ->select('*')
            ->join('tb_roles', 'tb_roles.id_role = pbb_users.pu_role_id')
            ->where('pu_id', $id)
            ->get()
            ->getRowArray();
        // ->where(['pu_id' => $id])->first();
    }
    public function cariData($cari)
    {
        return $this->table('user')->like('username', $cari);
    }
}
