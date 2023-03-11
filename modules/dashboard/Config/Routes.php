<?php

// define Users Routes

$routes->group('dashboard', static function ($routes) {
	foreach (['index','loadChartBS' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\dashboard\Controllers\Dashboard::$value");
    }
});