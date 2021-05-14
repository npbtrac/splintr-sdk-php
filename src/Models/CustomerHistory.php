<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class CustomerHistory
{
    use ConfigTrait;

    protected $gender;
    protected $registeredSince;
    protected $dob;
    protected $loyaltyScore;
    protected $wishlistCount;

    /**
     * CustomerHistory constructor.
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
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getRegisteredSince()
    {
        return $this->registeredSince;
    }

    /**
     * @return mixed
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @return mixed
     */
    public function getLoyaltyScore()
    {
        return $this->loyaltyScore;
    }

    /**
     * @return mixed
     */
    public function getWishListCount()
    {
        return $this->wishlistCount;
    }
}
