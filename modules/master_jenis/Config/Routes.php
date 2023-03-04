<?php

// define Users Routes

$routes->group('master_menu', static function ($routes) {
	foreach (['index','create, update, destroy' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\master_menu\Controllers\Master_menu::$value");
    }
});