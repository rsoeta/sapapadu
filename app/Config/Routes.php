<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Landing::index');
// $routes->get('/', 'Pbb\Auth::index');
// $routes->post('users', 'Users::index');

$routes->post('action', 'Wil::action');
$routes->match(['get', 'post'], 'lockscreen', 'Lockscreen::index');

// $routes->get('/', 'Pbb\Auth::index', ['filter' => 'noauthfilterpbb']);
$routes->post('cariPbb', 'Auth::cari');
$routes->match(['get', 'post'], 'login', 'Auth::login', ['filter' => 'noauthfilterpbb']);
$routes->get('logout', 'Auth::logout');
$routes->match(['get', 'post'], 'register', 'Auth::register', ['filter' => 'noauthfilterpbb']);
// $routes->get('pages', 'Pages::index', ['filter' => 'authfilterpbb']);
$routes->get('home', 'Pages::index', ['filter' => 'authfilterpbb']);
$routes->get('diagram', 'Pages::index2', ['filter' => 'authfilterpbb']);
// $routes->get('home', 'Dhkp22::index', ['filter' => 'authfilterpbb']);
// $routes->get('cache-this-page', 'Pages::index');

$routes->get('setting_web', 'Admin::setting_web', ['filter' => 'adminfilterpbb']);
$routes->post('get_count_desa/(:any)', 'Admin::get_count_desa/$1', ['filter' => 'adminfilterpbb']);
$routes->post('get_hitung', 'Admin::get_hitung', ['filter' => 'adminfilterpbb']);
$routes->get('menu_web', 'Admin::menu_web', ['filter' => 'adminfilterpbb']);
$routes->post('tb_menu', 'Admin::tb_menu', ['filter' => 'adminfilterpbb']);
$routes->post('editMenu', 'Admin::editMenu', ['filter' => 'adminfilterpbb']);
$routes->post('updateMenu', 'Admin::updateMenu', ['filter' => 'adminfilterpbb']);
$routes->post('modalMenu', 'Admin::modalMenu', ['filter' => 'adminfilterpbb']);
$routes->post('tambahMenu', 'Admin::tambahMenu', ['filter' => 'adminfilterpbb']);

$routes->get('dhkp', 'Dhkp::index', ['filter' => 'authfilterpbb']);
$routes->get('dhkp/terhutang', 'Dhkp::terutang', ['filter' => 'authfilterpbb']);
$routes->match(['get', 'post'], 'dhkp/pembayaran', 'Dhkp::index', ['filter' => 'authfilterpbb']);
$routes->get('dhkp21', 'Dhkp21::index', ['filter' => 'authfilterpbb']);
$routes->post('tb_dhkp21', 'Dhkp21::data_dhkp21', ['filter' => 'authfilterpbb']);
$routes->get('dhkp21/terhutang', 'Dhkp21::terutang', ['filter' => 'authfilterpbb']);
$routes->post('ambilDataPelanggan', 'Dhkp21::ambilDataPelanggan', ['filter' => 'authfilterpbb']);
$routes->post('editPbb21', 'Dhkp21::formedit', ['filter' => 'authfilterpbb']);
$routes->post('dhkp21/ekpor-dhkp21', 'Dhkp21::export', ['filter' => 'authfilterpbb']);

$routes->get('chart', 'Chart::index', ['filter' => 'authfilterpbb']);
$routes->get('dhkp', 'Dhkp::index', ['filter' => 'authfilterpbb']);
$routes->get('dhkp/(:num)', 'dhkp::detail', ['filter' => 'authfilterpbb']);
$routes->get('profil_user', 'Admin::detail', ['filter' => 'authfilterpbb']);
$routes->post('update_user', 'Admin::update_user', ['filter' => 'authfilterpbb']);
$routes->post('submit_lembaga', 'Admin::submit_lembaga', ['filter' => 'authfilterpbb']);
$routes->post('admin', 'Admin::index', ['filter' => 'authfilterpbb']);
$routes->get('datart', 'Wilayah::datart', ['filter' => 'authfilterpbb']);
$routes->get('datarw', 'Wilayah::datarw', ['filter' => 'authfilterpbb']);
$routes->get('datadusun', 'Wilayah::datadusun', ['filter' => 'authfilterpbb']);
// $routes->get('wilayah', 'Wilayah::index');

$routes->get('transaction21', 'Transaction21::index', ['filter' => 'authfilterpbb']);
$routes->post('trxAmbilData', 'Transaction21::ambildata', ['filter' => 'authfilterpbb']);
$routes->add('transaction21/pembayaran', 'Transaction21::pembayaran', ['filter' => 'authfilterpbb']);
$routes->post('transaction21/proses_import', 'Transaction::proses_import', ['filter' => 'authfilterpbb']);
$routes->add('export', 'Transaction21::export', ['filter' => 'authfilterpbb']);
$routes->add('exportRekRT', 'Transaction21::exportRekRT', ['filter' => 'authfilterpbb']);
$routes->add('transaction21/add', 'Transaction::add', ['filter' => 'authfilterpbb']);

$routes->get('dhkp22', 'Dhkp22::index', ['filter' => 'authfilterpbb']);
$routes->get('formTambah', 'Dhkp22::formTambah', ['filter' => 'authfilterpbb']);
$routes->post('getSppt', 'Dhkp22::getSppt', ['filter' => 'authfilterpbb']);
$routes->post('jumlahSppt', 'Dhkp22::jumlahSppt', ['filter' => 'authfilterpbb']);
$routes->post('jumlahTotal', 'Dhkp22::jumlahTotal', ['filter' => 'authfilterpbb']);
$routes->post('jumlahLunas', 'Dhkp22::jumlahLunas', ['filter' => 'authfilterpbb']);
$routes->post('jumlahTotalLunas', 'Dhkp22::jumlahTotalLunas', ['filter' => 'authfilterpbb']);
$routes->post('jumlahBelumLunas', 'Dhkp22::jumlahBelumLunas', ['filter' => 'authfilterpbb']);
$routes->post('jumlahTotalBelumLunas', 'Dhkp22::jumlahTotalBelumLunas', ['filter' => 'authfilterpbb']);
$routes->post('jumlahBermasalah', 'Dhkp22::jumlahBermasalah', ['filter' => 'authfilterpbb']);
$routes->post('jumlahTotalBermasalah', 'Dhkp22::jumlahTotalBermasalah', ['filter' => 'authfilterpbb']);
$routes->post('tb_dhkp22', 'Dhkp22::data_dhkp22', ['filter' => 'authfilterpbb']);
$routes->post('tb_dhkp22_1', 'Dhkp22::data_dhkp22_1', ['filter' => 'authfilterpbb']);
$routes->post('tb_dhkp22_2', 'Dhkp22::data_dhkp22_2', ['filter' => 'authfilterpbb']);
$routes->post('tb_dhkp22_lunas', 'Dhkp22::data_dhkp22_lunas', ['filter' => 'authfilterpbb']);
$routes->post('simpandatadhkp', 'Dhkp22::simpandatadhkp', ['filter' => 'authfilterpbb']);
$routes->post('dltPbb', 'Dhkp22::hapus', ['filter' => 'authfilterpbb']);
$routes->post('deleteSelected', 'Dhkp22::deleteSelected', ['filter' => 'authfilterpbb']);
$routes->post('editPbb', 'Dhkp22::formedit', ['filter' => 'authfilterpbb']);
$routes->post('updatedata', 'Dhkp22::updatedata', ['filter' => 'authfilterpbb']);
$routes->add('expFile', 'Dhkp22::exportBelumLunas', ['filter' => 'authfilterpbb']);
$routes->match(['get', 'post'], 'pbbterhutang', 'Dhkp22::pbbterhutang', ['filter' => 'authfilterpbb']);

$routes->add('trx22', 'Trx22::index', ['filter' => 'authfilterpbb']);
$routes->post('trx22AmbilData', 'Trx22::ambildata', ['filter' => 'authfilterpbb']);
$routes->post('dataDetail', 'Trx22::dataDetail', ['filter' => 'authfilterpbb']);
$routes->post('hapusItem', 'Trx22::hapusItem', ['filter' => 'authfilterpbb']);
$routes->get('trx22-pembayaran', 'Trx22::pembayaran', ['filter' => 'authfilterpbb']);
$routes->add('export22', 'Trx22::export', ['filter' => 'authfilterpbb']);
$routes->post('modalBayar', 'Trx22::bayar', ['filter' => 'authfilterpbb']);
$routes->post('simpanBayar', 'Trx22::simpanBayar', ['filter' => 'authfilterpbb']);
$routes->post('dataTerhutang', 'Trx22::dataTerhutang', ['filter' => 'authfilterpbb']);
$routes->post('listPbbTerhutang', 'Trx22::listPbbTerhutang', ['filter' => 'authfilterpbb']);
$routes->match(['get', 'post'], 'simpanTemp', 'Trx22::simpanTemp', ['filter' => 'authfilterpbb']);
$routes->post('hitungTotalBayar', 'Trx22::hitungTotalBayar', ['filter' => 'authfilterpbb']);
$routes->get('initChart', 'Dhkp22::initChart');

// API
$routes->resource('api/home', ['controller' => 'Api\Home']);

// $routes->get('inner-join', 'Site::innerJoinMethod');
// $routes->get('left-join', 'Site::leftJoinMethod');
// $routes->get('right-join', 'Site::rightJoinMethod');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
