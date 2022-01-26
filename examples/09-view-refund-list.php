<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$startDate = date('Y-m-d', strtotime('- 1 months'));
$endDate = date('Y-m-d', strtotime('now'));
$viewRefundsListRequest = $splintrClient->generateViewRefundsListRequest($startDate, $endDate, '3', '1');
$viewRefundsListResponse = $splintrClient->viewRefundsList($viewRefundsListRequest);
dump($viewRefundsListResponse);
dump($viewRefundsListResponse->getCount());
dump($viewRefundsListResponse->getRefunds()->getItems());
