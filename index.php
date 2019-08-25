<?php

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}

use Automattic\WooCommerce\Client;

$cli = new Client("http://www.lojadocartolafc.com.br", "ck_073dd3b2e4d1dfb0ce78d721f3d133b3edcc77da", "cs_aa43eb6378e53ff458ee76d01e6cd988d9c05a9d");


$data = [
    'line_items' => [
        [
            'product_id' => 327,
            'quantity' => 5,
            'meta_data' => [
                [
                    'key' => 'nome_estampado',
                    'value' => 'Paulo'
                ],
                [
                    'key' => 'numero_estampado',
                    'value' => '24'
                ],
                [
                    'key' => 'tamanho',
                    'value' => 'G'
                ],
                [
                    'key' => 'url_da_imagem',
                    'value' => 'www.sitebalbalbal.com.br'
                ]
            ]
        ]
    ]
];

$cli->post('orders', $data);
