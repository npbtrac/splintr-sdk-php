<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$startDate = date('Y-m-d', strtotime('- 1 months'));
$endDate = date('Y-m-d', strtotime('now'));
$viewInquiryListRequest = $splintrClient->generateViewInquiryListRequest($startDate, $endDate, '2', '1');
$viewInquiryListResponse = $splintrClient->viewInquiryList($viewInquiryListRequest);
dump($viewInquiryListResponse);
dump($viewInquiryListResponse->getInquiryList());
dump($viewInquiryListResponse->getInquiryList()->getItems());
