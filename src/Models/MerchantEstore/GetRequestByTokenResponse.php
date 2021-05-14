<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;

class GetRequestByTokenResponse extends BaseApiResponse
{
    protected $checkout;

    /**
     * @return array
     */
    public function getCheckout()
    {
        return $this->checkout;
    }
}