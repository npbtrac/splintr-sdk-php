<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewViewOrderRequest = $splintrClient->generateViewOrderRequest('SPR-1000-2981');
$viewOrderResponse = $splintrClient->viewOrder($viewViewOrderRequest);
dump($viewOrderResponse->getOrderDetails());
dump($viewOrderResponse->getOrderDetails()->getOrderId());
dump($viewOrderResponse->getOrderDetails()->getReferenceId());
