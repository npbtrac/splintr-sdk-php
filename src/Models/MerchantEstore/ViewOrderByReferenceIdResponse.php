<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\OrderDetails;

class ViewOrderByReferenceIdResponse extends BaseApiResponse
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
