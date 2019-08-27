<?php

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}

use Automattic\WooCommerce\Client;

$cli = new Client("http://www.lojadocartolafc.com.br", "ck_073dd3b2e4d1dfb0ce78d721f3d133b3edcc77da", "cs_aa43eb6378e53ff458ee76d01e6cd988d9c05a9d");

$jsonStr = '{"pedido": {"cliente": {"nome_cliente":"nome do cliente", "email":"cliente@mail.com", "telefone":"(11) 11111-1111", "cidade":"Cidade do Cliente", "estado":"SP"}, "produto": [{"nome_produto":"Camisa - Futebol Masculino","personalizacao":{"tam":["1","2","3","4","5","1","2","3","4","5"], "nome_jogadores":["nome 1","nome 2","nome 3","nome 4","nome 5","nome 6","nome 7","nome 8","nome 9","nome 10"], "num":["1","2","3","4","5","6","7","8","9","10"]},  "imagem": "http://www.lojadocartolafc.com.br/simulador/geradas/jogos/f0c5cbc8d91043ec372683c619684578", "quantidade":"10", "valor":"39"}, {"nome_produto":"Camisa - Futebol Masculino","personalizacao":{"tam":["1","2","3","4","5","1","2","3","4","5"], "nome_jogadores":["nome 1","nome 2","nome 3","nome 4","nome 5","nome 6","nome 7","nome 8","nome 9","nome 10"], "num":["1","2","3","4","5","6","7","8","9","10"]},  "imagem": "http://www.lojadocartolafc.com.br/simulador/geradas/jogos/f0c5cbc8d91043ec372683c619684578", "quantidade":"10", "valor":"39"}]}}';

$jsonObj = json_decode($jsonStr);

// acessando propriedades:
var_dump($jsonObj->pedido->produto[0]->nome_produto);

/**
 * falta:
 * "traduzir" nome do produto p ID
 * preencher os dados do cliente
 * foreach p percorer os produtos
 * arrumar campo no woocomemrce
 */

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
