<?php
/**
 * Create checkout session
 */

require_once 'vendor/autoload.php';

$splintrClient = new \Splintr\PhpSdk\Core\Client(
    [
        'baseUrl' => 'https://linked.splintr.xyz',
        'storePublicKey' => 'e4da3b7fbbce2345d7772b0674a318d5',
        'storeSecret' => 'ABCDEF-GHIKDSJ',
        'debugMode' => true,
    ]
);
$checkoutResponse = $splintrClient->createCheckoutRequest();

dump($checkoutResponse);

//$client = new \Splintr\PhpSdk\Dependencies\GuzzleHttp\Client();
////$client = new GuzzleHttp\Client();
//$response = $client->get('http://guzzlephp.org');
//
//dump($response);