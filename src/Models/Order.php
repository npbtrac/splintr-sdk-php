<?php


namespace Splintr\PhpSdk\Models;


use Splintr\PhpSdk\Traits\ConfigTrait;

class Order
{
    use ConfigTrait;

    const PRODUCT_TYPE_IBP = 'ibp';

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

    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    public function setItems(OrderItemCollection $orderItemCollection)
    {
        $this->items = $orderItemCollection;
    }

    public function setOrdersHistory(OrderHistoryCollection $orderHistoryCollection)
    {
        $this->ordersHistory = $orderHistoryCollection;
    }

    public function setCustomer(CustomerContact $customerContact)
    {
        $this->customer = $customerContact;
    }

    /**
     * Set a product type to the checkout request
     */
    public function setProductTypeIbp()
    {
        $this->productType = static::PRODUCT_TYPE_IBP;
    }

    public function generateRequestParams()
    {
        $params = [];
        $params = array_merge($params, $this->generateNonObjectParamsArrayFromAttributes());
        $params['items'] = $this->items->generateParamsArray();
        $params['customer'] = $this->customer->generateParamsArray();
        $params['orders_history'] = $this->ordersHistory->generateParamsArray();
//        array(
//            'store_public_key' => $this->storePublicKey,
//            'product_type' => 'ibp',
//            'reference_id' => '123467',
//            'currency' => 'AED',
//            'callback_url' => 'https://yourstore.com/callback',
//            'redirect_url' => 'https://yourstore.com/redirect',
//            'amount' => '200.00',
//            'shipping_amount' => '10.00',
//            'tax_amount' => '0',
//            'discount_amount' => '0',
//            'description' => 'something about the order',
//            'customer' =>
//                array(
//                    'email' => 'test@gmail.com',
//                    'phone' => '1458778965',
//                    'name' => 'Test Customer',
//                    'address' =>
//                        array(
//                            'line_1' => 'Business Bay',
//                            'city' => 'Dubai',
//                            'country' => 'AE',
//                        ),
//                    'history' =>
//                        array(
//                            'gender' => 'F',
//                            'registered_since' => '2018-08-01',
//                            'dob' => '1993-01-01',
//                            'loyalty_score' => '7',
//                            'wishlist_count' => '2',
//                        ),
//                ),
//            'items' =>
//                array(
//                    0 =>
//                        array(
//                            'quantity' => '1',
//                            'reference_id' => '123456',
//                            'title' => 'Shoe Pair',
//                            'unit_price' => '25',
//                            'image_url' => 'https://store.wordpress.com/2018/11/old-school-products.jpg',
//                            'product_url' => 'https://store.wordpress.com/2018/11/old-school-products.html',
//                            'description' => 'Good Pair of Shoes',
//                        ),
//                ),
//            'orders_history' =>
//                array(
//                    0 =>
//                        array(
//                            'amount' => '500',
//                            'payment_method' => 'paymentgateway',
//                            'ordered' => '1',
//                            'captured' => '1',
//                            'shipped' => '1',
//                            'refunded' => '0',
//                            'description' => 'pair of goods',
//                            'purchased_at' => '2019-01-01',
//                            'items' =>
//                                array(
//                                    0 =>
//                                        array(
//                                            'title' => 'product 1',
//                                            'unit_price' => '18.56',
//                                        ),
//                                ),
//                            'address' => 'somewhere in Dubai',
//                        ),
//                ),
//        ),
        return $params;
    }
}
