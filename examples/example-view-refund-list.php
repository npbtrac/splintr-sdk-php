<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewRefundsListRequest = $splintrClient->generateViewRefundsListRequest('2021-01-01', '2021-05-30', '3', '1');
$viewRefundsListResponse = $splintrClient->viewRefundsList($viewRefundsListRequest);
dump($viewRefundsListResponse);
dump($viewRefundsListResponse->getCount());
dump($viewRefundsListResponse->getRefunds()->getItems()['0']);
