<?php


namespace Splintr\PhpSdk\Models;


class GetRequestByTokenResponse extends BaseApiResponse
{
    protected $checkout;

    public function getCheckout()
    {
        return $this->checkout;
    }
}