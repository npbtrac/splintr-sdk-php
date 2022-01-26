<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$startDate = date('Y-m-d', strtotime('- 1 months'));
$endDate = date('Y-m-d', strtotime('now'));
$viewOrderListRequest = $splintrClient->generateViewOrderListRequest($startDate, $endDate, '10', '1', '2');
$viewOrderListResponse = $splintrClient->viewOrderList($viewOrderListRequest);
dump($viewOrderListResponse);
dump($viewOrderListResponse->getOrders()->getItems());
