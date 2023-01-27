<?php
$routes->group('playground', static function ($routes) {
	foreach (['index', 'create','read','update','delete' ] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\Playground\Controllers\Playground::$value");
    }
});