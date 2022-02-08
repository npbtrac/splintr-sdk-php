<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewOrderByReferenceIdRequest = $splintrClient->generateViewOrderByReferenceIdRequest('71');
$viewOrderByReferenceIdResponse = $splintrClient->viewOrderByReferenceId($viewOrderByReferenceIdRequest);
dump($viewOrderByReferenceIdResponse->getOrderDetails());
dump($viewOrderByReferenceIdResponse->getOrderDetails()->getOrderId());
dump($viewOrderByReferenceIdResponse->getOrderDetails()->getReferenceId());
