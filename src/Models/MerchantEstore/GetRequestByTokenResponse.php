<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;

class GetRequestByTokenResponse extends BaseApiResponse
{
    protected $checkout;

    public function getCheckout()
    {
        return $this->checkout;
    }
}