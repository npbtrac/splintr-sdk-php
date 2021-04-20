<?php


namespace Splintr\PhpSdk\Models;

class OrderItemCollection
{
    /** @var OrderItem[] */
    protected $items;

    /**
     * @param OrderItem $orderItem
     */
    public function addOrderItem(OrderItem $orderItem)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $orderItem;
    }

    public function generateParamsArray() {
        $params = [];
        foreach ($this->items as $tmpIndex => $item) {
            $params[] = $item->generateNonObjectParamsArrayFromAttributes();
        }

        return $params;
    }
}
