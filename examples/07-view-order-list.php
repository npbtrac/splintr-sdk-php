<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewOrderListRequest = $splintrClient->generateViewOrderListRequest('2021-01-01', '2021-04-30', '10', '3', '2');
$viewOrderListResponse = $splintrClient->viewOrderList($viewOrderListRequest);
dump($viewOrderListResponse->getOrders()->getItems());
