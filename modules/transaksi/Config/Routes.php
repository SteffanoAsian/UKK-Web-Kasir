<?php

// define Users Routes

$routes->group('transaksi', static function ($routes) {
    foreach (['index', 'loadMenu','loadMeja', 'addMenu', 'countTotalPrice','edit','prosesTransaksi'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\\transaksi\Controllers\\Transaksi::$value");
    }
});
