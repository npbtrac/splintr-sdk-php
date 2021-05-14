<?php


namespace Splintr\PhpSdk\Models;

class OrderItemCollection
{
    /** @var OrderItem[] */
    protected $items;

    /**
     * OrderItemCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $orderItem = new OrderItem($item);
            $this->addOrderItem($orderItem);
        }
    }

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

    /**
     * @return array
     */
    public function generateParamsArray()
    {
        $params = [];
        foreach ($this->items as $tmpIndex => $item) {
            $params[] = $item->generateNonObjectParamsArrayFromAttributes();
        }

        return $params;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
