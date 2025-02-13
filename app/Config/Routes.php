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
$routes->get('uploads/(:any)', 'FileController::getFile/$1');
$routes->get('admin/ubahdatapengguna', 'UbahDataController::ubahDataPengguna');
$routes->get('admin/ubahdatapengguna/(:num)', 'UbahDataController::ubahDataPengguna/$1');
$routes->delete('RiwayatAdminController/delete/(:segment)', 'RiwayatAdminController::delete/$1');
$routes->get('/pegawai/melihatpegawai', 'MelihatNotulenpegawaiController::lihat');
$routes->get('notulensi/lihatnotulen/(:num)', 'LihatNotulenController::lihatnotulen/$1');
$routes->get('notulen/detailnotulen/(:num)', 'LihatNotulenController::lihatnotulen/$1');
$routes->get('pegawai/riwayatpegawai', 'RiwayatPegawaiController::index');
$routes->get('notulen/riwayatnotulen', 'RiwayatNotulenController::index');
$routes->get('admin/ubahpassword', 'UbahPasswordController::ubah');
$routes->post('UbahPasswordController/ubah', 'UbahPasswordController::ubah');
$routes->post('admin/ubahdatapengguna/(:num)/update', 'UbahDataController::updatePengguna/$1');
$routes->post('UbahPasswordController/ubah', 'UbahPasswordController::ubah');
$routes->get('assets/images/profiles/(:any)', function() {
    return redirect()->to(base_url('/'));
});
$routes->post('save-feedback', 'LihatNotulenController::saveFeedback');
$routes->post('lihatnotulen/saveFeedback', 'LihatNotulenController::saveFeedback');
$routes->get('pegawai/lihatnotulen/(:num)', 'DetailnotulenController::lihatnotulen/$1');
$routes->post('lihatnotulen/saveFeedback', 'DetailnotulenController::saveFeedback');
$routes->get('pegawai/jadwalrapat', 'PegawaiJadwalController::index');
$routes->post('pegawai/jadwalrapat/add', 'PegawaiJadwalController::add');
$routes->post('pegawai-jadwal/save', 'PegawaiJadwalController::save');
$routes->get('/pegawai/jadwalrapat', 'PegawaiJadwalController::getAllJadwal');
$routes->get('admin/persetujuanadmin', 'PersetujuanAdminController::index');
$routes->post('admin/persetujuanadmin/approve_meeting/(:num)', 'PersetujuanAdminController::approveMeeting/$1');
$routes->post('admin/persetujuanadmin/reject_meeting/(:num)', 'PersetujuanAdminController::rejectMeeting/$1');
$routes->get('notulen/jadwalrapatnotulen', 'NotulenJadwalController::index');
$routes->post('notulen/jadwalrapatnotulen/add', 'NotulenJadwalController::add');
$routes->post('notulen-jadwal/save', 'NotulenJadwalController::save');
$routes->get('/notulen/jadwalrapanotulent', 'NotulenJadwalController::getAllJadwal');
$routes->get('admin/jadwalrapatadmin', 'NotulenJadwalrapatController::index');
$routes->get('notulen/historynotulen', 'HistoryEmailNotulenController::index');









