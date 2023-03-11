<?php

// define Users Routes

$routes->group('hakakses', static function ($routes) {
    foreach (['index', 'store', 'edit', 'update', 'destroy', 'getRoleMenu'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\hakakses\Controllers\Hakakses::$value");
    }
});
