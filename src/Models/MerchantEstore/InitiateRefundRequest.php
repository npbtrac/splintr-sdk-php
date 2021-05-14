<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiRequest;
use Splintr\PhpSdk\Models\Order;

class InitiateRefundRequest extends BaseApiRequest
{
    protected $orderId;
    protected $amount;
    protected $reason;
}
