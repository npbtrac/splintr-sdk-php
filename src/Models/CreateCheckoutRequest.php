<?php


namespace Splintr\PhpSdk\Models;


class CreateCheckoutRequest extends BaseApiRequest
{
    const PRODUCT_TYPE_IDP = 'idp';

    protected $productType;

    /**
     * @var Order
     */
    protected $order;

    /**
     * Set a product type to the checkout request
     *
     * @param $productType
     */
    public function setProductType($productType)
    {
        if ('ibp' !== strtolower($productType)) {
            $this->productType = static::PRODUCT_TYPE_IDP;
        }
    }

    /**
     * Get current product type of a checkout request
     *
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

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
