<?php

/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$startDate = date('Y-m-d', strtotime('- 1 months'));
$endDate = date('Y-m-d', strtotime('now'));
$viewSettlementsListRequest = $splintrClient->generateViewSettlementsListRequest($startDate, $endDate, '3', '1');
$viewSettlementsListResponse = $splintrClient->viewSettlementsList($viewSettlementsListRequest);
dump($viewSettlementsListResponse);
dump($viewSettlementsListResponse->getCount());
dump($viewSettlementsListResponse->getSettlements()->getItems());
