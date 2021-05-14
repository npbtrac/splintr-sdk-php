<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\InitiateRefund;

class InitiateRefundResponse extends BaseApiResponse
{
    protected $refund;

    public function getRefund()
    {
        return new InitiateRefund($this->refund);
    }
}


