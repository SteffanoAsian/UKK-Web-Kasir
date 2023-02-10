<?php

// define Users Routes

$routes->group('main', static function ($routes) {
	foreach (['index','getPage'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\Main\Controllers\Main::$value");
    }
});