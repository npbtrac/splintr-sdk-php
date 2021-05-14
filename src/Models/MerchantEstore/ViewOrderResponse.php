<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\OrderDetails;

class ViewOrderResponse extends BaseApiResponse
{
    protected $data;

    public function getOrderDetails()
    {
        $this->data = new OrderDetails($this->getData());
        return $this->data;
    }
}