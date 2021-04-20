<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\StreamInterface;

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
