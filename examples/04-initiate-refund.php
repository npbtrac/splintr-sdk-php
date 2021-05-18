<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$generateInitiateRefundRequest = $splintrClient->generateInitiateRefundRequest('SPR-1000-2998', '100', '1');
$initiateRefundResponse = $splintrClient->initiateRefund($generateInitiateRefundRequest);
dump($initiateRefundResponse->getRefund());
dump($initiateRefundResponse->getRefund()->getOrderId());
dump($initiateRefundResponse->getRefund()->getRefundId());
dump($initiateRefundResponse->getRefund()->getReason());
dump($initiateRefundResponse->getRefund()->getAmount());
