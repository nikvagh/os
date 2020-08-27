<?php

// SSLCommerz configuration

return [
    'projectPath' => env('PROJECT_PATH'),
    // 'projectPath' => env('APP_URL'),
    // For Sandbox, use "https://sandbox.sslcommerz.com"
    // For Live, use "https://securepay.sslcommerz.com"
    'apiDomain' => env("API_DOMAIN_URL", "https://sandbox.sslcommerz.com"),
    // 'apiDomain' => "https://sandbox.sslcommerz.com",
    'apiCredentials' => [
        'store_id' => env("STORE_ID"),
        'store_password' => env("STORE_PASSWORD"),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox, use "true", For Live, use "false"
    'success_url' => '/success_ssl',
    'failed_url' => '/fail_ssl',
    'cancel_url' => '/cancel',
    // 'cancel_url' => 'cancel_ssl.php',
    'ipn_url' => '/ipn_ssl',
];
