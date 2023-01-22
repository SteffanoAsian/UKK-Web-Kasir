<?php

$routes->group('app-login', static function ($routes) {
	foreach (['index', 'login' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\BackEnd\Login\Controllers\LoginController::{$value}");
    }
});