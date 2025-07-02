<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

/* ---------- REST RESOURCE ---------- */
$routes->resource('user',        ['controller' => 'UserController']);
$routes->resource('property',    ['controller' => 'PropertyController']);
$routes->resource('reservasi',   ['controller' => 'ReservasiController']);
$routes->resource('promosi',     ['controller' => 'PromosiController']);
$routes->resource('review',      ['controller' => 'ReviewController']);
$routes->resource('resepsionis', ['controller' => 'ResepsionisController']);
$routes->resource('payment',     ['controller' => 'PaymentController']);
$routes->resource('pemilik',     ['controller' => 'PemilikController']);

/* ---------- AUTH ---------- */
// Customer
$routes->post('register',        'AuthController::register');        // default → role customer
$routes->post('login/customer',  'AuthController::loginCustomer');

// Staff (pegawai & pemilik) → satu endpoint
$routes->post('login/staff',     'AuthController::loginStaff');

/* (Opsional) tetapkan alias lama supaya tidak merusak kode lama */
$routes->post('login/pegawai',   'AuthController::loginStaff');      // alias lama

$routes->group('', ['filter' => 'rolefilter:pemilik'], function ($routes) {
    $routes->post   ('resepsionis',         'ResepsionisController::create');
    $routes->put    ('resepsionis/(:num)',  'ResepsionisController::update/$1');
    $routes->delete ('resepsionis/(:num)',  'ResepsionisController::delete/$1');
});

$routes->group('', ['filter' => 'role:pemilik'], function($routes){
    $routes->resource('resepsionis', ['controller'=>'ResepsionisController']);
});

$routes->get('uploads/(:any)', 'UploadController::show/$1');
$routes->get('uploads/(:segment)', 'UploadController::show/$1');

// Tambahkan route untuk ringkasan hari ini
// $routes->get('ringkasan-hari-ini/(:num)', 'ReservasiController::ringkasanHariIni/$1');

// $routes->get('ringkasan-hari-ini/(:num)', 'RingkasanController::ringkasanHariIni/$1');

// $routes->get('ringkasan-hari-ini/(:any)', 'RingkasanController::ringkasanHariIni/$1');

// $routes->get('ringkasan-hari-ini/(:num)', 'RingkasanController::ringkasanHariIni/$1');

// $routes->get('ringkasan-hari-ini/(:any)', 'RingkasanController::ringkasanHariIni/$1');

$routes->get('ringkasan-hari-ini', 'RingkasanController::ringkasanHariIni');
$routes->get('ringkasan-hari-ini/(:any)', 'RingkasanController::ringkasanHariIni/$1');

$routes->resource('resepsionis');




