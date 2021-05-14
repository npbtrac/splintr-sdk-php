<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiRequest;

class ViewOrderListRequest extends BaseApiRequest
{
    protected $startDate;
    protected $endDate;
    protected $size;
    protected $from;
    protected $status;
}
