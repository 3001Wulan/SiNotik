<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login'); 
$routes->post('login', 'Auth::login');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::register');
$routes->get('admin/dashboard_admin', 'dashboardadminController::dashboardAdmin');
$routes->get('pegawai/dashboard_pegawai', 'dashboardpegawaIController::dashboardPegawai');
$routes->get('notulen/dashboard_notulen', 'DashboardNotulenController::dashboardNotulensi');
$routes->get('/home', 'Home::index');
$routes->get('admin/profiladmin', 'ProfilAdminController::profilAdmin');
$routes->get('notulen/profilnotulen', 'ProfilNotulenController::profilNotulen');
$routes->get('admin/data_pengguna', 'DetailPenggunaController::index');
$routes->get('admin/editprofil', 'EditProfilController::index');
$routes->post('admin/editprofil', 'EditProfilController::editProfil');
$routes->get('/editprofil/(:num)', 'EditProfilController::editProfil/$1');
$routes->get('pegawai/editprofilpegawai', 'EditProfilPegawaiController::index');
$routes->post('pegawai/editprofilpegawai', 'EditProfilPegawaiController::editProfil');
$routes->get('/editprofilpegawai/(:num)', 'EditProfilPegawaiController::editProfil/$1');
$routes->get('pegawai/profilpegawai', 'ProfilPegawaiController::profilPegawai');
$routes->post('DetailPenggunaController/hapusData', 'DetailPenggunaController::hapusData');
$routes->get('admin/riwayatadmin', 'RiwayatAdminController::index');
$routes->get('notulen/editprofilnotulwn', 'EditProfilNotulenController::index');
$routes->post('notulen/editprofilnotulen', 'EditProfilNotulenController::editProfil');
$routes->get('/editprofilnotulen/(:num)', 'EditProfilNotulenController::editProfil/$1');
$routes->get('admin/tambahpengguna', 'TambahPenggunaController::index');
$routes->post('tambah-pengguna/simpan', 'TambahPenggunaController::simpan');
$routes->get('detailpengguna/(:num)', 'DetailPenggunaControllers::detailPengguna/$1');
$routes->get('DetailPenggunaControllers/(:num)', 'DetailPenggunaControllers::index/$1');
$routes->get('/notulen/buatnotulen', 'NotulenController::create');
$routes->post('notulen/simpan', 'NotulenController::simpan');
$routes->get('/notulen/melihatnotulen', 'MelihatNotulenController::lihat');
$routes->get('/about', 'AboutController::about');



















