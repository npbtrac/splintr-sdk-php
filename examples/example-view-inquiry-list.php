<?php
/** @var  $splintrClient \Splintr\PhpSdk\Core\Client */
$splintrClient = require_once('example-client-config.php');

$viewInquiryListRequest = $splintrClient->generateViewInquiryListRequest('2021-01-01', '2021-04-30', '2', '1');
$viewInquiryListResponse = $splintrClient->viewInquiryList($viewInquiryListRequest);
dump($viewInquiryListResponse);
dump($viewInquiryListResponse->getInquiryList());
dump($viewInquiryListResponse->getInquiryList()->getItems());
