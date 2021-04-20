<?php


namespace Splintr\PhpSdk\Models;


class CreateCheckoutRequest extends BaseApiRequest
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->getOrder();
    }
}
