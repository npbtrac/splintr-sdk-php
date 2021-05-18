<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class Inquiry
{
    use ConfigTrait;

    protected $inquiryId;
    protected $decision;
    protected $status;
    protected $requestedAmount;
    protected $approvedAmount;
    protected $converted;
    protected $orderId;
    protected $referenceId;
    protected $productChoice;

    /**
     * @var CustomerContact $customer
     */
    protected $customer;

    /**
     * @var Address $address
     */
    protected $address;

    /**
     * @var OrderItemCollection $items
     */
    protected $items;

    /**
     * Inquiry constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config['customer'])) {
            $config['customer'] = new CustomerContact($config['customer']);
        }
        if (!empty($config['address'])) {
            $config['address'] = new Address($config['address']);
        }
        if (!empty($config['items'])) {
            $config['items'] = new OrderItemCollection($config['items']);
        }
        $this->bindConfig($config);
    }

    /**
     * @return mixed
     */
    public function getInquiryId()
    {
        return $this->inquiryId;
    }

    /**
     * @return mixed
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getRequestedAmount()
    {
        return $this->requestedAmount;
    }

    /**
     * @return mixed
     */
    public function getApprovedAmount()
    {
        return $this->approvedAmount;
    }

    /**
     * @return mixed
     */
    public function getConverted()
    {
        return $this->converted;
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
    public function getProductChoice()
    {
        return $this->productChoice;
    }

    /**
     * @return CustomerContact
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return OrderItem[]
     */
    public function getItems()
    {
        $orderItemCollection = new OrderItemCollection($this->items);

        return $orderItemCollection->getItems();
    }
}
