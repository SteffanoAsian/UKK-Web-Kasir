<?php

// define Users Routes

$routes->group('master_jenis', static function ($routes) {
	foreach (['index','store','update','edit','destroy' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\master_jenis\Controllers\Master_jenis::$value");
    }
});