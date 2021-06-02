<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');
$inquiryId = '5d2c4110938eb8d9f605e19e44446371-1158';

$viewInquiryRequest = $splintrClient->generateViewInquiryRequest($inquiryId);
$viewInquiryResponse = $splintrClient->viewInquiry($viewInquiryRequest);
dump($viewInquiryResponse->getInquiry()->getInquiryId());
dump($viewInquiryResponse->getInquiry()->getCustomer());
