<?php


namespace Splintr\PhpSdk\Models;


class OrderHistoryCollection
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

    public function generateParamsArray()
    {
        $params = [];
        foreach ($this->items as $tmpIndex => $item) {
            $params[] = $item->generateParamsArray();
        }

        return $params;
    }
}