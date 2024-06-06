<?php

function namaApp()
{
    return 'SAPA PADU';
}

function appVersion()
{
    return 'v2.3.2';
}

function deskApp()
{
    return 'Sistem Aplikasi Pajak Bumi dan Bangunan Pakenjeng Terpadu';
}

function profilAdmin()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pbb_users');
    $builder->select('*');
    $builder->where('pu_role_id', 1);
    $builder->join('tb_districts', 'tb_districts.id = pbb_users.pu_kode_kec');

    $query = $builder->get();

    return $query->getRow();
}

function logoApp()
{
    return base_url('favicon.png');
}

function detailUser()
{
    $db = \Config\Database::connect();
    $builder = $db->table('pbb_users');
    $builder->where('pu_id', session()->get('pu_id'));
    $builder->join('tb_roles', 'tb_roles.id_role = pbb_users.pu_role_id');
    $builder->join('tb_regencies', 'tb_regencies.id = pbb_users.pu_kode_kab');
    $builder->join('tb_districts', 'tb_districts.id = pbb_users.pu_kode_kec');
    if (session()->get('pu_role_id') !== '1') {
        $builder->join('tb_villages', 'tb_villages.id = pbb_users.pu_kode_desa');
        $builder->select('pu_id, pu_nik, pu_fullname, pu_user_image, pu_role_id, nm_role, pu_level, pu_kode_desa, tb_villages.name as nm_desa, pu_kode_kec, tb_districts.name as nm_kec, pu_kode_kab, tb_regencies.name as nm_kab');
    }
    $builder->select('pu_id, pu_nik, pu_fullname, pu_user_image, pu_role_id, nm_role, pu_level, pu_kode_desa, pu_kode_kec, tb_districts.name as nm_kec, pu_kode_kab, tb_regencies.name as nm_kab');
    $query = $builder->get();

    return $query->getRow();
}

function menu()
{
    $db = \Config\Database::connect();
    $builder = $db->table('tb_menu');
    $builder->select('tm_id, tm_sort, tm_nama, tm_class, tm_url, tm_icon, tm_parent_id, tm_status, tm_grup_akses');
    $builder->orderBy('tm_sort', 'asc');
    $query = $builder->get();

    return $query->getResultArray();
}

// how to make fuction menu_child?
function menu_child($menu_id)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tb_menu');
    $builder->select('tm_id, tm_nama, tm_class, tm_url, tm_icon, tm_parent_id, tm_status, tm_grup_akses');
    $builder->where('tm_parent_id', $menu_id);
    $builder->orderBy('tm_sort', 'asc');
    $query = $builder->get();
    return $query->getResultArray();
}

function menu_child_child($menu_child)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tb_menu');
    $builder->select('tm_id, tm_nama, tm_class, tm_url, tm_icon, tm_parent_id, tm_status, tm_grup_akses');
    $builder->where('tm_parent_id', $menu_child);
    $builder->orderBy('tm_sort', 'asc');
    $query = $builder->get();
    return $query->getResultArray();
}

function menu_child_child_child($menu_child_child)
{
    $db = \Config\Database::connect();
    $builder = $db->table('tb_menu');
    $builder->select('tm_id, tm_nama, tm_class, tm_url, tm_icon, tm_parent_id, tm_status, tm_grup_akses');
    $builder->where('tm_parent_id', $menu_child_child);
    $builder->orderBy('tm_sort', 'asc');
    $query = $builder->get();
    return $query->getResultArray();
}

function Foto_Profil($fileName = '', $dir = '', $defFile = '')
{
    if ($fileName !== '' && $fileName !== null && file_exists(FCPATH . $dir . '/' . $fileName)) {
        return base_url($dir . '/' . $fileName);
    } else {
        if ($defFile == '') {
            return base_url('img/default.png');
        } else {
            return base_url($defFile);
        }
    }
}

function dataTahun()
{
    $tahunAwal = 2020;
    $tahunAkhir = date('Y');
    $data = [];
    for ($i = $tahunAwal; $i <= $tahunAkhir; $i++) {
        $data[$i] = $i;
    }

    return $data;
}
