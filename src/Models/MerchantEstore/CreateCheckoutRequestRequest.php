<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiRequest;
use Splintr\PhpSdk\Models\Order;

class CreateCheckoutRequestRequest extends BaseApiRequest
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var string
     */
    protected $storePublicKey;

    /**
     * @var string
     */
    protected $appUrl;

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

    /**
     * @return array
     */
    public function generateRequestParams()
    {
        $params = parent::generateRequestParams();
        $params = array_merge($params, $this->getOrder()->generateRequestParams());

        return $params;
    }
}
