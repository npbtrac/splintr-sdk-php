<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiRequest;

class ViewRefundsListRequest extends BaseApiRequest
{
    protected $startDate;
    protected $endDate;
    protected $size;
    protected $from;
}