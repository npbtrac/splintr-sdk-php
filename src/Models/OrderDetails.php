<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class OrderDetails
{
    use ConfigTrait;

    protected $orderId;
    protected $referenceId;
    protected $statusInteger;
    protected $status;
    protected $productChoice;

    /** @var SettlementCollection */
    protected $settlements;

    /** @var RefundCollection */
    protected $refunds;

    /** @var OrderItemCollection */
    protected $items;

    /** @var OrderHistoryCollection */
    protected $history;

    /**
     * OrderDetails constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config['settlements'])) {
            $config['settlements'] = new SettlementCollection($config['settlements']);
        }
        if (!empty($config['refunds'])) {
            $config['refunds'] = new RefundCollection($config['refunds']);
        }
        if (!empty($config['items'])) {
            $config['items'] = new OrderItemCollection($config['items']);
        }
        if (!empty($config['history'])) {
            $config['history'] = new OrderHistoryCollection($config['history']);
        }

        $this->bindConfig($config);
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return mixed
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * @return mixed
     */
    public function getStatusInteger()
    {
        return $this->statusInteger;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getProductChoice()
    {
        return $this->productChoice;
    }

    /**
     * @return SettlementCollection
     */
    public function getSettlements()
    {
        return $this->settlements;
    }

    /**
     * @return RefundCollection
     */
    public function getRefunds()
    {
        return $this->refunds;
    }

    /**
     * @return OrderItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return OrderHistoryCollection
     */
    public function getHistory()
    {
        return $this->history;
    }
}
