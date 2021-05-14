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

    /** @var OrderItemCollection */
    protected $items;

    /** @var Address */
    protected $address;

    /**
     * OrderHistory constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    /**
     * @param OrderItemCollection $orderItemCollection
     */
    public function setItems(OrderItemCollection $orderItemCollection)
    {
        $this->items = $orderItemCollection;
    }

    /**
     * @return array
     */
    public function generateParamsArray()
    {
        $params = $this->generateNonObjectParamsArrayFromAttributes();
        $params['address'] = $this->address->toString();
        $params['items'] = $this->items->generateParamsArray();

        return $params;
    }
}
