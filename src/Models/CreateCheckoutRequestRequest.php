<?php


namespace Splintr\PhpSdk\Models;


class CreateCheckoutRequestRequest extends BaseApiRequest
{
    /**
     * @var Order
     */
    protected $order;
    protected $storePublicKey;

    /**
     * @param Order $order
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function generateRequestParams()
    {
        $params = parent::generateRequestParams();
        $params = array_merge($params, $this->getOrder()->generateRequestParams());

        return $params;
    }
}
