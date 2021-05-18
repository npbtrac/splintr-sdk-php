<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\OrderDetails;

class ViewOrderResponse extends BaseApiResponse
{
    protected $data;

    /**
     * @return OrderDetails
     */
    public function getOrderDetails()
    {
        return new OrderDetails($this->data);
    }
}
