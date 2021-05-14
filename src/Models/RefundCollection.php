<?php


namespace Splintr\PhpSdk\Models;

class RefundCollection
{
    /** @var Refund[] */
    protected $items;

    /**
     * RefundCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $refundItem = new Refund($item);
            $this->addRefundItem($refundItem);
        }
    }

    /**
     * @param Refund $refundItem
     */
    public function addRefundItem(Refund $refundItem)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $refundItem;
    }

    /**
     * @return Refund[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
