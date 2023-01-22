<?php

// define Users Routes

// $routes->get('users', '\Modules\Users\Controllers\Users::index');
$routes->group('users', static function ($routes) {
	foreach (['index', 'login','test2' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\Users\Controllers\Users::$value");
    }
});