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

    /**
     * Address constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    /**
     * Desired format
     * Line1,
     * Line2,
     * City,
     * State,
     * Country
     *
     * @return string
     */
    public function toString()
    {
        $result = '';
        $address = [
            $this->line1,
            $this->line2,
            $this->city,
            $this->state,
            $this->country,
        ];
        $separator = ', '.PHP_EOL;
        array_walk($address, function ($value) use (&$result, $separator) {
            $result .= (!empty($value)) ? $value.$separator : '';
        });

        return trim($result, $separator);
    }

    /**
     * @return mixed
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @return mixed
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
}
