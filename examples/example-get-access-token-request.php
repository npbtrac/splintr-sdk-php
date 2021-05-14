<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$getAccessTokenRequest = $splintrClient->generateGetAccessTokenRequest();
$getAccessTokenResponse = $splintrClient->getAccessToken($getAccessTokenRequest);
dump($getAccessTokenResponse);
dump($getAccessTokenResponse->getAccessToken());
dump($getAccessTokenResponse->getScopes());
dump($getAccessTokenResponse->getExpiredAt());
