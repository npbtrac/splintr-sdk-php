<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

//$getRequestByTokenRequest = $splintrClient->generateGetRequestByTokenRequest($createCheckoutResponse->getToken());
$getRequestByTokenRequest = $splintrClient->generateGetRequestByTokenRequest('935b1546-67f6-4114-95a8-7fe51bad0469');
$getRequestByTokenResponse = $splintrClient->getRequestByToken($getRequestByTokenRequest);
dump($getRequestByTokenResponse);
dump($getRequestByTokenResponse->getCheckout());
