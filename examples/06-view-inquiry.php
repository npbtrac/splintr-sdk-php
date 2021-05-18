<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewInquiryRequest = $splintrClient->generateViewInquiryRequest('18e9432c8551565f677cc7a2ffb7b077-1079');
$viewInquiryResponse = $splintrClient->viewInquiry($viewInquiryRequest);
dump($viewInquiryResponse->getInquiry());
dump($viewInquiryResponse->getInquiry()->getCustomer());
