<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;

class CreateCheckoutRequestResponse extends BaseApiResponse
{
    protected $token;
    protected $expiry;

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        return 'https://react.splintr.xyz/checkout-process/' . $this->token;
    }
}
