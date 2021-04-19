<?php


namespace Splintr\PhpSdk\Models;


use Splintr\PhpSdk\Traits\ConfigTrait;

class Order
{
    use ConfigTrait;

    protected $referenceId;
    protected $currency;
    protected $callbackUrl;
    protected $redirectUrl;
    protected $amount;
    protected $shippingAmount;
    protected $taxAmount;
    protected $discountAmount;
    protected $description;
    protected $items;
    protected $ordersHistory;

    /** @var OrderItemCollection */
    protected $orderItemCollection;

    /** @var CustomerContact */
    protected $customer;

    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    public function setOrderCollection(OrderItemCollection $orderItemCollection)
    {
        $this->orderItemCollection = $orderItemCollection;
    }

    public function setOrdersHistory(OrdersHistory $ordersHistory)
    {
        $this->ordersHistory = $ordersHistory;
    }
}
