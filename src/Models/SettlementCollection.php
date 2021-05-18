<?php


namespace Splintr\PhpSdk\Models;

class SettlementCollection
{
    /** @var Settlement[] */
    protected $items;

    /**
     * SettlementCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $settlementItem = new Settlement($item);
            $this->addSettlementItem($settlementItem);
        }
    }

    /**
     * @param Settlement $settlementItem
     */
    public function addSettlementItem(Settlement $settlementItem)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $settlementItem;
    }

    /**
     * @return Settlement[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
