<?php
return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),

    'sandbox' => [
        'client_id'     => env('PAYPAL_SANDBOX_CLIENT_ID'),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET'),
        'app_id'        => '', // Not required for basic payments
    ],


    'currency' => env('PAYPAL_CURRENCY', 'USD'),

    'notify_url' => '', // Optional: IPN Listener

    'locale' => 'en_US',
];
