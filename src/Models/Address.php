<?php


namespace Splintr\PhpSdk\Models;


use Splintr\PhpSdk\Traits\ConfigTrait;

class Address
{
    use ConfigTrait;

    protected $line1;
    protected $line2;
    protected $city;
    protected $state;
    protected $country;

    public function __construct($config)
    {
        $this->bindConfig($config);
    }
}
