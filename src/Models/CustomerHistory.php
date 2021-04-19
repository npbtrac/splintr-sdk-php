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

    public function __construct($config)
    {
        $this->bindConfig($config);
    }
}
