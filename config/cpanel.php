<?php
return [
    'subdomain_path' => env('CPANEL_SUBDOMAIN_PATH'),
    'url' => env('CPANEL_URL'),
    'port' => env('CPANEL_PORT', 2083),
    'prefix_db' => env('PREFIX_DATABASE'),
    'username' => env('CPANEL_USERNAME'),
    'token' => env('CPANEL_TOKEN'),
    'mysql_user' => env('DB_MANAGER_USERNAME'),
    'mysql_password' => env('DB_MANAGER_PASSWORD'),
    'domains_not_allowed' => 'cpanel,' . env('DOMAINS_NOT_ALLOWED')
];
