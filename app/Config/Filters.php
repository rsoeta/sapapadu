<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\AuthFilterPbb;
use App\Filters\NoauthFilterPbb;
use App\Filters\AdminFilterPbb;
use App\Filters\OprFilterPbb;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     			=> CSRF::class,
		'toolbar'  			=> DebugToolbar::class,
		'honeypot' 			=> Honeypot::class,
		'authfilterpbb'    	=> AuthFilterPbb::class,
		'noauthfilterpbb'   => NoauthFilterPbb::class,
		'adminfilterpbb'	=> AdminFilterPbb::class,
		'oprfilterpbb'		=> OprFilterPbb::class,
		// 'login'      => \Myth\Auth\Filters\LoginFilter::class,
		// 'role'       => \Myth\Auth\Filters\RoleFilter::class,
		// 'permission' => \Myth\Auth\Filters\PermissionFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		// 'before' => [
		// 	// 'honeypot',
		// 'csrf',
		// 	// 'login'
		// 	'authfilterDtks' => ['except' => [
		// 		'/', '/*',
		// 		'dtks/auth', 'dtks/auth/*',
		// 	]],
		// 	'authfilterpbb' => ['except' => [
		// 		'/', '/*',
		// 		'pbb/auth', 'pbb/auth/*',
		// 	]],
		// 	'authfiltersitbsp' => ['except' => [
		// 		'/', '/*',
		// 		'sitbsp/auth', 'sitbsp/auth/*',
		// 	]]
		// ],
		'after'  => [
			// 'honeypot',
			// 'authfilterpbb' => ['except' => [
			// 'pbb/user', 'pbb/user/*',
			// 'pbb/menu', 'pbb/menu/*',
			// 'pbb/dhkp', 'pbb/dhkp/*',
			// 'pbb/dhkp21', 'pbb/dhkp21/*',
			// ]],
			'toolbar',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [
		// 'login' => ['before' => ['kas/pages', 'sitbsp', 'pbb']],
		'oprfilterpbb' => [
			'before' => [
				'pbb/dhkp',
				'pbb/dhkp/*',
				'pbb/dhkp21',
				'pbb/dhkp21/*',
				'pbb/formTambah',
				'pbb/simpandatadhkp',
				'pbb/editPbb',
				'pbb/dltPbb',
				'pbb/updatedata',
				'pbb/expFile',
				'pbb/trx22',
				'pbb/trx22/*',
				'pbb/transaction21',
				'pbb/transaction21/*',
				'pbb/admin',
				'pbb/admin/*',
				'pbb/datart',
				'pbb/datarw',
				'pbb/datadusun',
				'pbb/wilayah',
				'pbb/wilayah/*',
				'pbb/pelanggan',
				'pbb/pelanggan/*',
			]
		]
	];
}
