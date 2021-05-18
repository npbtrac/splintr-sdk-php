<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$getAccessTokenRequest = $splintrClient->generateGetAccessTokenRequest();
$getAccessTokenResponse = $splintrClient->getAccessToken($getAccessTokenRequest);
dump($getAccessTokenResponse->isSuccess());
dump($getAccessTokenResponse);

dump($getAccessTokenRequest->getApiEndpoint());
