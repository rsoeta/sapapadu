<?php

namespace App\Controllers;

use App\Models\Pbb\DhkpModel22;

class Landing extends BaseController
{
	public function __construct()
	{
		$this->DhkpModel22 = new DhkpModel22();
	}
	public function index()
	{
		// echo 'Hello World!';
		$diagramKecamatan = $this->DhkpModel22->getDiagramKecamatan();
		$data = [
			'diagramKecamatan' => $diagramKecamatan,
		];

		return view('landing', $data);
	}
}
