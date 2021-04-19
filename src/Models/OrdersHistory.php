<?php


namespace Splintr\PhpSdk\Models;


class OrdersHistory
{
    /** @var OrderHistory[] */
    protected $items;

    /**
     * @param OrderHistory $orderHistory
     */
    public function addOrderHistory(OrderHistory $orderHistory)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $orderHistory;
    }
}
