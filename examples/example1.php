<?php
/**
 * Create checkout session
 */

require_once 'vendor/autoload.php';

/**
 * "store_secret": "9332B5CF-5937-4C4F-AEC8-FAB5BE0D7871",
 * "store_key": "865f5bafbf83f5efd97ff1922462c022",
 * "store_public_key": "9332B5CF-5B31-46A5-8B19-E2B96330FB10",
 */

$splintrClient = new \Splintr\PhpSdk\Core\Client(
    [
        'baseUrl' => 'https://linked.splintr.xyz',
        'storePublicKey' => '9332B5CF-5B31-46A5-8B19-E2B96330FB10',
        'storeKey' => '865f5bafbf83f5efd97ff1922462c022',
        'storeSecret' => '9332B5CF-5937-4C4F-AEC8-FAB5BE0D7871',
        'debugMode' => true,
    ]
);

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
    'email' => 'test@gmail.com',
    'phone' => '1458778965',
    'name' => 'Test Customer',
    'address' => new \Splintr\PhpSdk\Models\Address([
        'line_1' => 'Business Bay',
        'city' => 'Dubai',
        'country' => 'AE',
    ]),
    'history' => new \Splintr\PhpSdk\Models\CustomerHistory([
        'gender' => 'F',
        'registered_since' => '2018-08-01',
        'dob' => '1993-01-01',
        'loyalty_score' => '7',
        'wishlist_count' => '2',
    ]),
]));
$order->setProductTypeIbp();

//dump($order);
$createCheckoutRequestRequest = $splintrClient->generateCreateCheckoutRequestRequest($order);
$createCheckoutResponse = $splintrClient->createCheckoutRequest($createCheckoutRequestRequest);
dump($createCheckoutResponse);

$getAccessTokenRequest = $splintrClient->generateGetAccessTokenRequest();
$getAccessTokenResponse = $splintrClient->getAccessToken($getAccessTokenRequest);
dump($getAccessTokenResponse);

$getRequestByTokenRequest = $splintrClient->generateGetRequestByTokenRequest($createCheckoutResponse->getToken());
dump($getRequestByTokenRequest);
$getRequestByTokenResponse = $splintrClient->getRequestByToken($getRequestByTokenRequest);
dump($getRequestByTokenResponse);
