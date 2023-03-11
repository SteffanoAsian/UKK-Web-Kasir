<?php

// define Users Routes

$routes->group('master_meja', static function ($routes) {
	foreach (['index','store','update','edit','destroy' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\master_meja\Controllers\Master_meja::$value");
    }
});