<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->setDefaultNamespace('App\Controllers');


$routes->group('user/', ['filter' => 'authuser'], function ($routes) {
    $routes->get('my-profile', 'User\User::index');
    $routes->get('attendance', 'User\User::attendance');
    $routes->add('attendanceProccess', 'User\User::attendanceProcess');
    $routes->get('permission', 'User\User::permission');
    $routes->post('permission', 'User\User::permissionProcess');
    $routes->add('history', 'User\User::history');
    $routes->get('setting', 'User\User::setting');
    $routes->post('setting', 'User\User::settingProcess');
});
$routes->get('/', 'User\Auth::login', ['filter' => 'noauth']);
$routes->group('/', ['filter' => 'noauth'], function ($routes) {
    $routes->get('login', 'User\Auth::login');
    $routes->post('login', 'User\Auth::loginProcess');
    $routes->add('forgetpassword', 'User\Auth::forgetPassword');
    $routes->add('resetpassword', 'User\Auth::resetPassword');
    $routes->post('resetpassword', 'User\Auth::resetPasswordProcess');
    $routes->get('verifikasi', 'User\Auth::verifikasi');
    $routes->post('verifikasi', 'User\Auth::verifikasiProcess');
});
$routes->add('kirim_ulang', 'User\Auth::kirim_ulang');

$routes->group('user/', ['filter' => 'authregister'], function ($routes) {
    $routes->get('index', 'User\Auth::index');
    $routes->post('index', 'User\Auth::indexHandler');
});


$routes->group('/', ['filter' => 'noauthregister'], function ($routes) {
    $routes->get('register', 'User\Auth::register');
    $routes->post('register', 'User\Auth::registerProcess');
});


$routes->get('user/logout', 'User\Auth::logout');
$routes->get('/logout', 'User\Auth::logout');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('profile', 'Admin\Admin::profile_Admin');
    $routes->post('profile', 'Admin\Admin::profile_AdminProcess');
    $routes->get('dashboard', 'Admin\Admin::dashboard');
    $routes->get('data-absen', 'Admin\Admin::data_absen');
    $routes->post('data-absen', 'Admin\Admin::data_absen_filter');
    $routes->get('data-siswa', 'Admin\Admin::data_siswa');
    $routes->get('data-mahasiswa', 'Admin\Admin::data_mahasiswa');
    $routes->get('instansi-sekolah', 'Admin\Admin::instansi_sekolah');
    $routes->post('instansi-modal', 'Admin\Modal::instansi_modal');
    $routes->get('instansi-universitas', 'Admin\Admin::instansi_universitas');
    $routes->get('rekap-siswa', 'Admin\Admin::rekap_siswa');
    $routes->post('rekap-siswa', 'Admin\Admin::rekap_siswaFilter');
    $routes->get('rekap-mahasiswa', 'Admin\Admin::rekap_mahasiswa');
    $routes->post('rekap-mahasiswa', 'Admin\Admin::rekap_mahasiswaFilter');
    $routes->get('super-admin', 'Admin\SuperAdmin::super_admin', ['filter' => 'superadmin']);
    $routes->get('list-super-admin', 'Admin\SuperAdmin::list_super_admin');
});

$routes->add('data-absenProcess', 'Admin\Modal::tambahAbsensiProcess');