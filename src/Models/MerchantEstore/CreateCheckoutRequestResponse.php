<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\StreamInterface;
use Splintr\PhpSdk\Models\BaseApiResponse;

class CreateCheckoutRequestResponse extends BaseApiResponse
{
    protected $token;
    protected $expiry;

    public function getToken()
    {
        return $this->token;
    }

    public function getExpiry()
    {
        return $this->expiry;
    }
}
