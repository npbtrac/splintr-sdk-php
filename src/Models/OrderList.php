<?php


namespace Splintr\PhpSdk\Models;

class OrderList
{
    /** @var OrderListItemDetails[] */
    protected $items;

    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $orderListItem = new OrderListItemDetails($item);
            $this->adSettlementItem($orderListItem);
        }
    }

    /**
     * @param OrderListItemDetails $orderListItem
     */
    public function adSettlementItem(OrderListItemDetails $orderListItem)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $orderListItem;
    }

    /**
     * @return OrderListItemDetails[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
