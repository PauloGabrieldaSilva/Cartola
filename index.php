<?php

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}

use Automattic\WooCommerce\Client;

$cli = new Client("http://www.lojadocartolafc.com.br", "ck_073dd3b2e4d1dfb0ce78d721f3d133b3edcc77da", "cs_aa43eb6378e53ff458ee76d01e6cd988d9c05a9d");


$todayOrder = [
    'produto' => [
        'nome'              => 'Camisa Goleiro',
        'personalizacao'    => [
            'tam'   => ['1', '2', '3'],
            'nome'  => ['joao', 'jose', 'agnaldo'],
            'num'   => ['12', '45', '30']
        ],
        'imagem'            => 'http://[bla].jpg',
        'quantidade'        => '3',
        'valor'             => '39'
    ]
];

$picaOrder = [
    'billing'       => [
        'first_name' => 'Teste_01'
    ],
    'line_items'    => [
        [
            'name'      => 'Camisa Goleiro',
            'quantity'  => 3,
            'price'     => '39,00',
            'meta_data' => [
                'tam'   => ['1', '2', '3'],
                'nome'  => ['joao', 'jose', 'agnaldo'],
                'num'   => ['12', '45', '30'],
                'img'   => 'www.google.com'
            ]
        ]
    ]
];

$data = [
    'line_items' => [
        [
            'name'  => 'Camisa - editada',
            'product_id' => 74,
            'quantity' => 3,
            'tam'   => 1
        ]
    ]
];

$nota = ['note' => 'NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA NOTA'];
$cli->post('orders/321/notes', $nota);
