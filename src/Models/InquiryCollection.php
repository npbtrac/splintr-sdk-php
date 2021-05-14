<?php


namespace Splintr\PhpSdk\Models;

class InquiryCollection
{
    /** @var Inquiry[] */
    protected $items;

    /**
     * InquiryCollection constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach ($items as $tmpKey => $item) {
            $inquiryItem = new Inquiry($item);
            $this->addInquiryItem($inquiryItem);
        }
    }

    /**
     * @param Inquiry $inquiryItem
     */
    public function addInquiryItem(Inquiry $inquiryItem)
    {
        if (empty($this->items) || !is_array($this->items)) {
            $this->items = [];
        }

        $this->items[] = $inquiryItem;
    }

    /**
     * @return Inquiry[]
     */
    public function getItems()
    {
        return $this->items;
    }
}
