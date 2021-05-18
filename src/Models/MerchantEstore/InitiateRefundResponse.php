<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\InitiateRefund;

class InitiateRefundResponse extends BaseApiResponse
{
    protected $refund;

    /**
     * @return InitiateRefund
     */
    public function getRefund()
    {
        return new InitiateRefund($this->refund);
    }
}
