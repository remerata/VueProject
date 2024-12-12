<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],  // Allow all methods (GET, POST, PUT, DELETE)

    'allowed_origins' => [
        'http://localhost:8080',
        'http://127.0.0.1:8000'
    ],  // Allow both frontend origins

    'allowed_origins_patterns' => [],
    
    'allowed_headers' => ['*'],  // Allow all headers

    'exposed_headers' => false,

    'max_age' => 0,

    'supports_credentials' => true,
];

