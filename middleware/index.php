<?php

$autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( is_readable( $autoloader ) ) {
	require_once $autoloader;
}

use Automattic\WooCommerce\Client;

function customOrdered(array $size, array $name, array $number) {
    $orderedCustom = '';
    for ($i=0; $i < count($size) ; $i++) { 
        $orderedCustom .= "<strong>Tamanho:</strong> {$size[$i]}, <strong>Nome:</strong> {$name[$i]}, <strong>Número:</strong> {$number[$i]}<br>";
    }
    return $orderedCustom;
}

function productSync(array $prods, $nameFromApi) {
    foreach ($prods as $name => $id) {
        if ($name == $nameFromApi) {
            $prodId = $id;
        } else {
            continue;
        }
    }
    return $prodId;
}

$cli = new Client("http://www.lojadocartolafc.com.br", "ck_073dd3b2e4d1dfb0ce78d721f3d133b3edcc77da", "cs_aa43eb6378e53ff458ee76d01e6cd988d9c05a9d");

$jsonStr = '{"pedido": {"cliente": {"nome_cliente":"nome do cliente", "email":"cliente@mail.com", "telefone":"(11) 11111-1111", "cidade":"Cidade do Cliente", "estado":"SP"}, "produto": [{"nome_produto":"Camisa - Futebol Masculino","personalizacao":{"tam":["1","2","3","4","5","1","2","3","4","5"], "nome_jogadores":["nome 1","nome 2","nome 3","nome 4","nome 5","nome 6","nome 7","nome 8","nome 9","nome 10"], "num":["1","2","3","4","5","6","7","8","9","10"]},  "imagem": "http://www.lojadocartolafc.com.br/simulador/geradas/jogos/f0c5cbc8d91043ec372683c619684578", "quantidade":"10", "valor":"39"}, {"nome_produto":"Camisa - Futebol Masculino","personalizacao":{"tam":["1","2","3","4","5","1","2","3","4","5"], "nome_jogadores":["nome 1","nome 2","nome 3","nome 4","nome 5","nome 6","nome 7","nome 8","nome 9","nome 10"], "num":["1","2","3","4","5","6","7","8","9","10"]},  "imagem": "http://www.lojadocartolafc.com.br/simulador/geradas/jogos/f0c5cbc8d91043ec372683c619684578", "quantidade":"10", "valor":"39"}]}}';

$jsonObj = json_decode($jsonStr);

$items = [];
$prods = [
    'Camisa - Futebol Masculino' => 74,
    'Camisa - Futebol Masculino - Goleiro' => 327
];

foreach ($jsonObj->pedido->produto as $prod) {
    $prodID = productSync($prods, $prod->nome_produto);
    $item = [
        'product_id' => $prodID,
        'quantity' => $prod->quantidade,
        'meta_data' => [
            [
                'key' => 'personalizacao',
                'value' => customOrdered($prod->personalizacao->tam, $prod->personalizacao->nome_jogadores, $prod->personalizacao->num)
            ],
            [
                'key' => 'url_da_imagem',
                'value' => $prod->imagem
            ]
        ]
    ];
    array_push($items, $item);
}

$data = [
    'billing' => [
        'first_name' => $jsonObj->pedido->cliente->nome_cliente,
        'city' => $jsonObj->pedido->cliente->cidade,
        'state' => $jsonObj->pedido->cliente->estado,
        'country' => 'BR',
        'email' => $jsonObj->pedido->cliente->email,
        'phone' => $jsonObj->pedido->cliente->telefone
    ],
    'line_items' => $items
];

$cli->post('orders', $data);
