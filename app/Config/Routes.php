<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/login/register', 'Login::register');
$routes->post('/login/save', 'Login::save');
$routes->post('/login/proses', 'Login::proses');
$routes->get('login/keluar', 'login::keluar');

$routes->get('wisata', 'Wisata::index');
$routes->get('wisata/pesan/(:segment)', 'Wisata::pesan/$1');
$routes->post('Wisata/proses', 'Wisata::proses');
$routes->get('Wisata/konfirmasi/(:segment)', 'Wisata::konfirmasi/$1');
$routes->get('/Wisata/detailTiket/(:num)', 'Wisata::detailTiket/$1');

$routes->group('admin', function ($routes) {
    $routes->get('/', 'admin\Home::index');
    $routes->get('home', 'admin\Home::index');
    $routes->get('Wisata', 'admin\Wisata::index');
    $routes->get('Wisata/add', 'admin\Wisata::add');
    $routes->post('Wisata/save', 'admin\Wisata::save');
    $routes->get('Wisata/edit/(:segment)', 'admin\Wisata::edit/$1');
    $routes->post('Wisata/update', 'admin\Wisata::update');
    $routes->get('Wisata/delete/(:segment)', 'admin\Wisata::delete/$1');

    $routes->get('login', 'admin\login::index');
    $routes->post('login/cek', 'admin\Login::cek');
    $routes->get('login/keluar', 'admin\Login::keluar');

    $routes->get('petugas', 'admin\petugas::index');
    $routes->get('petugas/add', 'admin\petugas::add');
    $routes->post('petugas/save', 'admin\petugas::save');
    $routes->get('petugas/delete/(:segment)', 'admin\petugas::delete/$1');
    $routes->get('petugas/edit/(:segment)', 'admin\petugas::edit/$1');
    $routes->post('petugas/update', 'admin\petugas::update');
});
