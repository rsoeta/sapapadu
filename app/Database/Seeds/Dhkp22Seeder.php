<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Pbb\DhkpModel22;

class Dhkp22Seeder extends Seeder
{
	public function run()
	{
		$model = new DhkpModel22();
		// 32.05.33.2011	DEPOK
		// 32.05.33.2008	JATIWANGI
		// 32.05.33.2013	JAYAMEKAR
		// 32.05.33.2012	KARANGSARI
		// 32.05.33.2001 	NEGLASARI
		// 32.05.33.2009	PANYINDANGAN
		// 32.05.33.2006	PASIRLANGU
		// 32.05.33.2005	SUKAMULYA
		// 32.05.33.2007	TALAGAWANGI
		// 32.05.33.2002	TANJUNGJAYA
		// 32.05.33.2003	TANJUNGMULYA
		// 32.05.33.2010	TEGALGEDE
		// 32.05.33.2004	WANGUNJAYA
		$pd_prov = '32';
		$kode_prov = '32';

		$pd_kab = '05';
		$kode_kab = '07';

		$pd_kec = '33';
		$kode_kec = '040';
		// 007 = DEPOK, 
		// 011 = JATIWANGI, 
		// 013 = JAYAMEKAR
		// 001 = KARANGSARI,  
		// 005 = NEGLASARI, 
		// 009 = PANYINDANGAN, 
		// 008 = PASIRLANGU, 
		// 006 = SUKAMULYA, 
		// 012 = TALAGAWANGI, 
		// 003 = TANJUNGJAYA,
		// 002 = TANJUNGMULYA, 
		// 004 = TEGALGEDE, 
		// 010 = WANGUNJAYA, 
		$pd_desa = '2004';
		$kode_kel = '010';
		$user = session()->get('pu_nik');
		$faker = \Faker\Factory::create('id_ID');
		for ($i = 0; $i < 815; $i++) {
			$nama = $faker->name;
			$kode_blok = $faker->randomNumber($nbDigits = 3, $strict = true);
			$kode_urut = $faker->randomNumber($nbDigits = 4, $strict = true);
			$data = [
				'nop' => $kode_prov . '.' . $kode_kab . '.' . $kode_kec . '.' . $kode_kel . '.' . $kode_blok . '-' . $kode_urut . '.' . '0',
				'nama_wp' => strtoupper($nama),
				'alamat_wp' => strtoupper($faker->streetAddress),
				'alamat_op' => strtoupper($faker->streetAddress),
				'bumi' => $faker->numberBetween(20, 1000),
				'bgn' => $faker->numberBetween(0, 100),
				'pajak' => $faker->numberBetween(23000, 100000),
				'nik_wp' => $faker->nik(),
				'nama_ktp' => strtoupper($nama),
				'pd_prov' => $pd_prov,
				'pd_kab' => $pd_prov . '.' . $pd_kab,
				'pd_kec' => $pd_prov . '.' . $pd_kab . '.' . $pd_kec,
				'pd_desa' => $pd_prov . '.' . $pd_kab . '.' . $pd_kec . '.' . $pd_desa,
				'dusun' => $faker->numberBetween(1, 3),
				'rw' => $faker->numberBetween(1, 13),
				'rt' => $faker->numberBetween(1, 8),
				// 'pd_ket' => $faker->numberBetween(0, 1),
				'pd_ket' => 1,
				// 'pd_ket' => 0,
				'pd_creator' => $user,
				'pd_updater' => $user,
			];
			$model->insert($data);
		}
		//
	}
}
