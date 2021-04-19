<?php


namespace Splintr\PhpSdk\Models;


use Splintr\PhpSdk\Traits\ConfigTrait;

class OrderHistory
{
    use ConfigTrait;

    protected $amount;
    protected $paymentMethod;
    protected $ordered;
    protected $captured;
    protected $shipped;
    protected $refunded;
    protected $description;
    protected $purchasedAt;
    protected $items;

    /** @var OrderItemCollection */
    protected $orderItemCollection;

    /** @var Address */
    protected $address;

    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    public function setOrderCollection(OrderItemCollection $orderItemCollection)
    {
        $this->orderItemCollection = $orderItemCollection;
    }
}
