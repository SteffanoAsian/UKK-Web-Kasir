<?php

// define Users Routes

$routes->group('list_transaksi', static function ($routes) {
    foreach (['index', 'store', 'edit', 'update', 'destroy', 'loadAdminKasir'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\list_transaksi\Controllers\List_transaksi::$value");
    }
});
