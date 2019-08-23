<?php

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}

use Automattic\WooCommerce\Client;

$cli = new Client("http://www.lojadocartolafc.com.br", "ck_073dd3b2e4d1dfb0ce78d721f3d133b3edcc77da", "cs_aa43eb6378e53ff458ee76d01e6cd988d9c05a9d");

$data = ['payment_method' => 'bacs',
'payment_method_title' => 'Direct Bank Transfer',
'set_paid' => true,
'billing' => [
    'first_name' => 'PRIMEIRO NOME',
    'last_name' => 'ÚLTIMO NOME',
    'address_1' => '969 Market',
    'address_2' => '',
    'city' => 'San Francisco',
    'state' => 'CA',
    'postcode' => '94103',
    'country' => 'US',
    'email' => 'john.doe@example.com',
    'phone' => '(555) 555-5555'
],
'shipping' => [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'address_1' => '969 Market',
    'address_2' => '',
    'city' => 'San Francisco',
    'state' => 'CA',
    'postcode' => '94103',
    'country' => 'US'
],
'line_items' => [
    [
        'product_id' => 93,
        'quantity' => 2
    ],
    [
        'product_id' => 22,
        'variation_id' => 23,
        'quantity' => 1
    ]
]
];

$cli->post('orders', $data);
