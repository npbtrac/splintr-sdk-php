<?php
/**
 * Create checkout session
 */

use Splintr\PhpSdk\Core\Client;

require_once 'vendor/autoload.php';
/**
 * @var $splintrClient Client
 */
$splintrClient = require_once('example-client-config.php');

$orderItemCollection = new \Splintr\PhpSdk\Models\OrderItemCollection();
$orderItemCollection->addOrderItem(new \Splintr\PhpSdk\Models\OrderItem([
    'quantity' => '1',
    'reference_id' => '123456',
    'title' => 'Shoe Pair',
    'unit_price' => '25',
    'image_url' => 'https://store.wordpress.com/2018/11/old-school-products.jpg',
    'product_url' => 'https://store.wordpress.com/2018/11/old-school-products.html',
    'description' => 'Good Pair of Shoes',
]));
$orderItemCollection->addOrderItem(new \Splintr\PhpSdk\Models\OrderItem([
    'quantity' => '2',
    'reference_id' => '56789',
    'title' => 'Shoe Pair Bad',
    'unit_price' => '18',
    'image_url' => 'https://store.wordpress.com/2018/11/old-school-products.jpg',
    'product_url' => 'https://store.wordpress.com/2018/11/old-school-products.html',
    'description' => 'Bad Pair of Shoes',
]));

$ordersHistory = new \Splintr\PhpSdk\Models\OrderHistoryCollection();

$orderHistory = new \Splintr\PhpSdk\Models\OrderHistory([
    'amount' => '500',
    'payment_method' => 'paymentgateway',
    'ordered' => '1',
    'captured' => '1',
    'shipped' => '1',
    'refunded' => '0',
    'description' => 'pair of goods',
    'purchased_at' => '2019-01-01',
    'address' => new \Splintr\PhpSdk\Models\Address([
        'line_1' => 'Business Bay',
        'city' => 'Dubai',
        'country' => 'AE',
    ]),
]);

$orderItemCollectionForOrderHistory = new \Splintr\PhpSdk\Models\OrderItemCollection();
$orderItemCollectionForOrderHistory->addOrderItem(new \Splintr\PhpSdk\Models\OrderItem([
    'quantity' => '1',
    'reference_id' => '123456',
    'title' => 'Shoe Pair',
    'unit_price' => '25',
    'image_url' => 'https://store.wordpress.com/2018/11/old-school-products.jpg',
    'product_url' => 'https://store.wordpress.com/2018/11/old-school-products.html',
    'description' => 'Good Pair of Shoes',
]));
$orderHistory->setItems($orderItemCollectionForOrderHistory);

$ordersHistory->addOrderHistory($orderHistory);

$order = new \Splintr\PhpSdk\Models\Order([
    'reference_id' => '123467',
    'currency' => 'AED',
    'callback_url' => 'https://yourstore.com/callback',
    'redirect_url' => 'https://yourstore.com/redirect',
    'amount' => '200.00',
    'shipping_amount' => '10.00',
    'tax_amount' => '0',
    'discount_amount' => '0',
    'description' => 'something about the order',
]);
$order->setItems($orderItemCollection);
$order->setOrdersHistory($ordersHistory);
$order->setCustomer(new \Splintr\PhpSdk\Models\CustomerContact([
    'email' => 'peterego360+testcustomer@gmail.com',
    'phone' => '+971511223344',
    'name' => 'Dev User',
    'address' => [
        'line_1' => 'Business Bay',
        'city' => 'Dubai',
        'country' => 'AE',
    ],
    'history' => new \Splintr\PhpSdk\Models\CustomerHistory([
        'gender' => 'F',
        'registered_since' => '2018-08-01',
        'dob' => '1993-01-01',
        'loyalty_score' => '7',
        'wishlist_count' => '2',
    ]),
]));
$order->setProductTypeIbp();
$createCheckoutRequestRequest = $splintrClient->generateCreateCheckoutRequestRequest($order);
$createCheckoutResponse = $splintrClient->createCheckoutRequest($createCheckoutRequestRequest);
dump($order);
dump($createCheckoutResponse);
dump($createCheckoutResponse->getCheckoutUrl());

$getRequestByTokenRequest = $splintrClient->generateGetRequestByTokenRequest($createCheckoutResponse->getToken());
dump($getRequestByTokenRequest);
