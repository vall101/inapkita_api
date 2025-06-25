<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->resource('user', ['controller' => 'UserController']);
$routes->resource('property', ['controller' => 'PropertyController']);
$routes->resource('reservasi', ['controller' => 'ReservasiController']);
$routes->resource('promosi', ['controller' => 'PromosiController']);
$routes->resource('review', ['controller' => 'ReviewController']);
$routes->resource('resepsionis', ['controller' => 'ResepsionisController']);
$routes->resource('payment', ['controller' => 'PaymentController']);
$routes->resource('pemilik', ['controller' => 'pemilikController']);







