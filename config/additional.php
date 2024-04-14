<?php

return [
    'pagination' => env('PAGINATION', 10),

    'docker' => [
        'db' => [
            'port' => env('DOCKER_DB_PORT', 5434),
        ],
        'web' => [
            'port' => env('DOCKER_WEB_PORT', 8000),
        ],
    ]
];
