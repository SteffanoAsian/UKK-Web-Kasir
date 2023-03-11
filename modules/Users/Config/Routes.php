<?php

$routes->group('Users', static function ($routes) {
    foreach (['index', 'edit', 'loadRole', 'update', 'store', 'destroy'] as $key => $value) {
        $routes->add((($value == 'index') ? '/' : $value), "\Modules\Users\Controllers\Users::$value");
    }
});
