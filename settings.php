<?php
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [

            'dev_mode' => true,

            'cache_dir' => APP_ROOT . '/var/doctrine',

            'metadata_dirs' => [APP_ROOT . '/src/Models/Entity'],

            'connection' => [
                'dbname' => 'testing',
                'user' => 'root',
                'password' => 'admin',
                'host' => 'localhost:3306',
                'driver' => 'pdo_mysql',
            ]
        ]
    ]
];