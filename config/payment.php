<?php

return [
    'midtrans' => [
        'merchant' => [
            'id' => env('MIDTRANS_MERCHANT_ID'),
        ],
        'client' => [
            'key' => env('MIDTRANS_CLIENT_KEY'),
        ],
        'server' => [
            'key' => env('MIDTRANS_SERVER_KEY'),
        ],
    ],
];
