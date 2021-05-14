<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class Settlement
{
    use ConfigTrait;

    protected $id;
    protected $amount;
    protected $msf;
    protected $settlement;
    protected $isProcessed;
    protected $comment;
    protected $createdAt;
    protected $updatedAt;
    protected $orderAmount;
    protected $orderNumber;

    /**
     * Settlement constructor.
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
    public function getMsf()
    {
        return $this->msf;
    }

    /**
     * @return mixed
     */
    public function getSettlement()
    {
        return $this->settlement;
    }

    /**
     * @return mixed
     */
    public function getIsProcessed()
    {
        return $this->isProcessed;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
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
    public function getOrderAmount()
    {
        return $this->orderAmount;
    }

    /**
     * @return mixed
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }
}
