<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class Refund
{
    use ConfigTrait;

    protected $id;
    protected $amount;
    protected $deductions;
    protected $isRefunded;
    protected $isPartial;
    protected $isApproved;
    protected $isDeclined;
    protected $refundedOn;
    protected $reason;
    protected $createdAt;
    protected $updatedAt;
    protected $orderNumber;

    /**
     * Refund constructor.
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
    public function getId()
    {
        return $this->id;
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
    public function getDeductions()
    {
        return $this->deductions;
    }

    /**
     * @return mixed
     */
    public function getIsRefunded()
    {
        return $this->isRefunded;
    }

    /**
     * @return mixed
     */
    public function getIsPartial()
    {
        return $this->isPartial;
    }

    /**
     * @return mixed
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * @return mixed
     */
    public function getIsDeclined()
    {
        return $this->isDeclined;
    }

    /**
     * @return mixed
     */
    public function getRefundedOn()
    {
        return $this->refundedOn;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

}