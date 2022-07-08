<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// ADMIN ROUTES
$routes->get('/admin', 'Admin::index', ['filter' => 'AdminFilter']);
$routes->group('admin', ['filter' => 'AdminFilter'], static function ($routes) {
    $routes->get('kgb', 'Admin::kgb');
    $routes->get('kgb/detail/(:any)', 'Admin::kgb_detail/$1');
    $routes->get('usulan_kgb', 'Admin::usulan_kgb');
    $routes->get('usulan_kgb/detail/(:any)', 'Admin::usulan_kgb_detail/$1');
    $routes->post('usulan_kgb/terima', 'Admin::usulan_kgb_terima');
    $routes->post('usulan_kgb/tolak', 'Admin::usulan_kgb_tolak');
    $routes->get('kelola_pengguna', 'Admin::kelola_pengguna');
    $routes->post('perbaharui_pengguna', 'Admin::perbaharui_pengguna');
    $routes->post('daftar_pengguna', 'Admin::daftar_pengguna');
});

// AUTHENTICATION ROUTES
$routes->get('/authentication', 'Authentication::index');
$routes->post('/authentication/login', 'Authentication::login');
$routes->get('/authentication/logout', 'Authentication::logout');
$routes->get('/authentication/register_admin', 'Authentication::register_admin');

// DASHBOARD ROUTES
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

// KGB ROUTES
$routes->get('/kgb/daftar_pegawai', 'Kgb::daftar_pegawai');
$routes->get('/kgb/tambah_riwayat/(:any)', 'Kgb::tambah_riwayat/$1');
$routes->post('/kgb/perbaharui_riwayat', 'Kgb::perbaharui_riwayat');

$routes->get('/kgb/edit/(:any)', 'Kgb::edit/$1');
$routes->post('/kgb/simpan', 'Kgb::simpan');
$routes->get('/kgb/tambah', 'Kgb::tambah');
$routes->get('/kgb/riwayat', 'Kgb::riwayat');
$routes->get('/kgb/riwayat/diterima', 'Kgb::riwayat_diterima');
$routes->post('/kgb/riwayat/ditolak', 'Kgb::riwayat_ditolak');
$routes->post('/kgb/riwayat/menunggu_verifikasi', 'Kgb::riwayat_menunggu_verifikasi');

// PENGGUNA ROUTES
$routes->get('/pengguna/ganti_password', 'Pengguna::ganti_password');
$routes->post('/pengguna/simpan_password', 'Pengguna::simpan_password');
$routes->post('/pengguna/get_pegawai', 'Pengguna::get_pegawai');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
