<?php

namespace App\Models\Pbb;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'pbb_users';
    protected $primaryKey = 'pu_id';

    protected $allowedFields = ['pu_nik', 'pu_email', 'pu_username', 'pu_fullname', 'pu_password', 'pu_level', 'pu_jabatan', 'pu_status', 'pu_status_message', 'pu_role_id', 'pu_user_image', 'pu_user_lembaga_id', 'pu_nope', 'pu_kode_desa', 'pu_kode_kec', 'pu_kode_kab', 'pu_kode_prov', 'pu_created_at', 'pu_updated_at', 'pu_deleted_at', 'pu_created_by', 'pu_updated_by', 'pu_deleted_by'];

    protected $useTimestamps = true;
    protected $createdField  = 'pu_created_at';
    protected $updatedField  = 'pu_updated_at';
    protected $deletedField  = 'pu_deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = ["beforeInsert"];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (isset($data['data']['pu_password'])) {
            $data['data']['pu_password'] = password_hash($data['data']['pu_password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    public function save_register($data)
    {
        $this->db->table('pbb_users')->insert($data);
    }

    public function login($email, $password)
    {
        return $this->db->table('pbb_users')->where([
            'pu_email' => $email,
            'pu_password' => $password,
        ])->get()->getRowArray();
    }

    public function getUserId()
    {
        $user_id = detailUser()->pu_id;

        $builder = $this->db->table($this->table);
        $builder->select('pbb_users.pu_id as id_user, pbb_users.pu_password, pbb_users.pu_nik, pbb_users.pu_fullname, pbb_users.pu_email, pbb_users.pu_kode_desa, pbb_users.pu_kode_kec, pbb_users.pu_kode_kab, pbb_users.pu_user_image, pbb_users.pu_user_lembaga_id, pu_nope, pbb_users.pu_created_at, pbb_users.pu_updated_at, tb_roles.id_role as role_id, tb_roles.nm_role, lembaga_profil.lp_id, lembaga_profil.lp_kode, lembaga_profil.lp_kepala, lembaga_profil.lp_nip, lembaga_profil.lp_sekretariat, lembaga_profil.lp_email, lembaga_profil.lp_kode_pos, lembaga_profil.lp_logo, lembaga_kategori.lk_nama, tb_villages.name as nama_desa');
        $builder->join('tb_roles', 'pbb_users.pu_role_id=tb_roles.id_role');
        $builder->join('lembaga_profil', 'pbb_users.pu_id=lembaga_profil.lp_user');
        $builder->join('lembaga_kategori', 'pbb_users.pu_role_id=lembaga_kategori.lk_id');
        $builder->join('tb_villages', 'pbb_users.pu_kode_desa=tb_villages.id');
        $query = $builder->getWhere(['pbb_users.pu_id' => $user_id])->getRowArray();

        $buildar = $this->db->table($this->table);
        $buildar->select('pbb_users.pu_id as id_user, pbb_users.pu_password, pbb_users.pu_nik, pbb_users.pu_fullname, pbb_users.pu_email, pbb_users.pu_kode_desa, pbb_users.pu_kode_kec, pbb_users.pu_kode_kab, pbb_users.pu_user_image, pbb_users.pu_user_lembaga_id, pu_nope, pbb_users.pu_created_at, pbb_users.pu_updated_at, tb_roles.id_role as role_id, tb_roles.nm_role, lembaga_profil.lp_id, lembaga_profil.lp_kode, lembaga_profil.lp_kepala, lembaga_profil.lp_nip, lembaga_profil.lp_sekretariat, lembaga_profil.lp_email, lembaga_profil.lp_kode_pos, lembaga_profil.lp_logo, lembaga_kategori.lk_nama');
        $buildar->join('tb_roles', 'pbb_users.pu_role_id=tb_roles.id_role');
        $buildar->join('lembaga_profil', 'pbb_users.pu_id=lembaga_profil.lp_user');
        $buildar->join('lembaga_kategori', 'pbb_users.pu_role_id=lembaga_kategori.lk_id');
        $buildar->join('tb_districts', 'pbb_users.pu_kode_kec=tb_districts.id');
        $buildar->join('tb_regencies', 'pbb_users.pu_kode_kab=tb_regencies.id');
        $quera = $buildar->getWhere(['pbb_users.pu_id' => $user_id])->getRowArray();

        $buildor = $this->db->table($this->table);
        $buildor->select('pbb_users.pu_id as id_user, pbb_users.pu_password, pbb_users.pu_nik, pbb_users.pu_fullname, pbb_users.pu_email, pbb_users.pu_kode_desa, pbb_users.pu_kode_kec, pbb_users.pu_kode_kab, pbb_users.pu_user_image, pbb_users.pu_user_lembaga_id, pu_nope, pbb_users.pu_created_at, pbb_users.pu_updated_at, tb_roles.id_role as role_id, tb_roles.nm_role');
        $buildor->join('tb_roles', 'pbb_users.pu_role_id=tb_roles.id_role');
        // $buildor->join('lembaga_profil', 'pbb_users.pu_id=lembaga_profil.lp_user');
        // $buildor->join('lembaga_kategori', 'lembaga_profil.lp_kategori=lembaga_kategori.lk_id');
        // $buildor->join('tb_villages', 'lembaga_profil.lp_kode=tb_villages.id');
        $quero = $buildor->where('pbb_users.pu_id', $user_id);
        $quero = $quero->get()->getRowArray();

        // case isset $query, $quera, $quero
        if ($query) {
            return $query;
        } elseif ($quera) {
            return $quera;
        } elseif ($quero) {
            return $quero;
        } else {
            return false;
        }
        // if (isset($query)) {
        //     return $query;
        // } elseif (isset($quera)) {
        //     return $quera;
        // } else {
        //     return $quero;
        // }
    }

    public function updatePersonalData($id_user, $personalData)
    {
        return $this->db
            ->table($this->table)
            ->where(["pu_id" => $id_user])
            ->set($personalData)
            ->update();
    }
}
