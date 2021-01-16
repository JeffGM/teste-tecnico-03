<?php
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [

            'dev_mode' => true,

            'cache_dir' => APP_ROOT . '/var/doctrine',

            'metadata_dirs' => [],

            'connection' => []
        ]
    ]
];