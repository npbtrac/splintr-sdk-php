<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\StreamInterface;
use Splintr\PhpSdk\Models\BaseApiResponse;

class CreateCheckoutRequestResponse extends BaseApiResponse
{
    protected $token;
    protected $expiry;
    protected $checkoutUrl;

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
        return $this->checkoutUrl;
    }
}
