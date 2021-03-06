<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class Order
{
    use ConfigTrait;

    const PRODUCT_TYPE_IBP = 'ibp';
    const PRODUCT_TYPE_PDP = 'pdp';

    protected $productType;
    protected $referenceId;
    protected $currency;
    protected $callbackUrl;
    protected $redirectUrl;
    protected $amount;
    protected $shippingAmount;
    protected $taxAmount;
    protected $discountAmount;
    protected $description;

    /** @var OrderHistoryCollection */
    protected $ordersHistory;

    /** @var OrderItemCollection */
    protected $items;

    /** @var CustomerContact */
    protected $customer;

    /**
     * Order constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
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
     * @return OrderItemCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param OrderHistoryCollection $orderHistoryCollection
     */
    public function setOrdersHistory(OrderHistoryCollection $orderHistoryCollection)
    {
        $this->ordersHistory = $orderHistoryCollection;
    }

    /**
     * @return OrderHistoryCollection
     */
    public function getOrdersHistory()
    {
        return $this->ordersHistory;
    }

    /**
     * @param CustomerContact $customerContact
     */
    public function setCustomer(CustomerContact $customerContact)
    {
        $this->customer = $customerContact;
    }

    /**
     * @return CustomerContact
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set a product type to the checkout request
     *
     * @param $productType
     */
    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    /**
     * @return mixed
     */
    public function getProductType()
    {
        return $this->productType;
    }

    /**
     * Set a product type to the checkout request
     */
    public function setProductTypePdp()
    {
        $this->productType = static::PRODUCT_TYPE_PDP;
    }

    /**
     * Set a product type to Pay by Instalments
     */
    public function setProductTypeIbp()
    {
        $this->productType = static::PRODUCT_TYPE_IBP;
    }

    /**
     * Set a product type to Pay Later
     */
    public function setProductTypePbp()
    {
        $this->productType = static::PRODUCT_TYPE_PDP;
    }

    /**
     * @return array
     */
    public function generateRequestParams()
    {
        $params = [];
        $params = array_merge($params, $this->generateNonObjectParamsArrayFromAttributes());
        $params['items'] = $this->items->generateParamsArray();
        $params['customer'] = $this->customer->generateParamsArray();
        $params['orders_history'] = $this->ordersHistory->generateParamsArray();

        return $params;
    }
}
