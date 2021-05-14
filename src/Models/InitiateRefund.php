<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class InitiateRefund
{
    use ConfigTrait;

    protected $orderId;
    protected $refundId;
    protected $createdOn;
    protected $partial;
    protected $amount;
    protected $approved;
    protected $reason;

    /**
     * InitiateRefund constructor.
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
    public function getRefundId()
    {
        return $this->refundId;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return mixed
     */
    public function getPartial()
    {
        return $this->partial;
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
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @return mixed
     */
    public function getReason()
    {
        return $this->reason;
    }
}