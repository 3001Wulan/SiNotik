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
$routes->get('/home', 'Home::index');
$routes->get('admin/profiladmin', 'ProfilAdminController::profilAdmin');
$routes->get('admin/data_pengguna', 'DetailPenggunaController::index');
$routes->get('admin/editprofil', 'EditProfilController::index');
$routes->post('admin/editprofil', 'EditProfilController::editProfil');
$routes->get('/editprofil/(:num)', 'EditProfilController::editProfil/$1');
$routes->get('pegawai/editprofilpegawai', 'EditProfilController::index');
$routes->post('pegawai/editprofilpegawai', 'EditProfilController::editProfil');
$routes->get('pegawai/profilpegawai', 'ProfilPegawaiController::profilPegawai');







