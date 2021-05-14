<?php


namespace Splintr\PhpSdk\Models;

class OrderHistoryCollection
{
    /** @var OrderHistory[] */
    protected $items;

    /**
     * OrderHistoryCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $historyItem = new OrderHistory($item);
            $this->addOrderHistory($historyItem);
        }
    }

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

    /**
     * @return array
     */
    public function generateParamsArray()
    {
        $params = [];
        foreach ($this->items as $tmpIndex => $item) {
            $params[] = $item->generateParamsArray();
        }

        return $params;
    }
}
