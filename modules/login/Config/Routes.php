<?php

// define Users Routes

$routes->group('app-login', static function ($routes) {
	foreach (['index','doLogin','logout'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\Login\Controllers\Login::$value");
    }
});