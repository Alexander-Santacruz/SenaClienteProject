<?php

return [
    'api_url' => env('ADMIN_SENA_API_URL', 'http://localhost/AdminSena/public/api'),
    'database' => [
        'host' => env('ADMIN_SENA_DB_HOST', env('DB_HOST', '127.0.0.1')),
        'port' => env('ADMIN_SENA_DB_PORT', env('DB_PORT', '3306')),
        'database' => env('ADMIN_SENA_DB_DATABASE', 'adminsena'),
        'username' => env('ADMIN_SENA_DB_USERNAME', env('DB_USERNAME', 'root')),
        'password' => env('ADMIN_SENA_DB_PASSWORD', env('DB_PASSWORD', '')),
        'unix_socket' => env('ADMIN_SENA_DB_SOCKET', env('DB_SOCKET', '')),
    ],
];
