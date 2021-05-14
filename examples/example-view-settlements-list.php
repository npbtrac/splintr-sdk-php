<?php

/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewSettlementsListRequest = $splintrClient->generateViewSettlementsListRequest('2021-01-01', '2021-04-30', '3', '1');
$viewSettlementsListResponse = $splintrClient->viewSettlementsList($viewSettlementsListRequest);
dump($viewSettlementsListResponse);
dump($viewSettlementsListResponse->getCount());
dump($viewSettlementsListResponse->getSettlements()->getItems()['0']);
