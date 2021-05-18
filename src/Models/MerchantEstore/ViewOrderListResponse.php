<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\OrderList;

class ViewOrderListResponse extends BaseApiResponse
{
    protected $allOrders;
    protected $orders;

    /**
     * @return mixed
     */
    public function getAllOrders()
    {
        return $this->allOrders;
    }

    /**
     * @return OrderList
     */
    public function getOrders()
    {
        return new OrderList($this->orders);
    }
}
