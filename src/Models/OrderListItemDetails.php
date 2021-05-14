<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class OrderListItemDetails
{
    use ConfigTrait;

    protected $orderId;
    protected $checkoutId;
    protected $name;
    protected $email;
    protected $phone;
    protected $referenceId;
    protected $productType;
    protected $status;
    protected $productChoice;
    protected $amount;
    protected $userAddedOn;
    protected $orderedOn;
    protected $msf;
    protected $statusInteger;

    /**
     * OrderListItemDetails constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->bindConfig($config);
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
    public function getCheckoutId()
    {
        return $this->checkoutId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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
    public function getProductType()
    {
        return $this->productType;
    }

    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getProductChoice()
    {
        return $this->productChoice;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getUserAddedOn()
    {
        return $this->userAddedOn;
    }

    /**
     * @return mixed
     */
    public function getOrderedOn()
    {
        return $this->orderedOn;
    }

    /**
     * @return mixed
     */
    public function getMsf()
    {
        return $this->msf;
    }

    /**
     * @return mixed
     */
    public function getStatusInteger()
    {
        return $this->statusInteger;
    }
}
