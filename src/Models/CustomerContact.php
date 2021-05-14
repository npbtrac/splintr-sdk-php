<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

class CustomerContact
{
    use ConfigTrait;

    protected $email;
    protected $phone;
    protected $name;

    /** @var Address */
    protected $address;

    /** @var CustomerHistory */
    protected $history;

    /**
     * CustomerContact constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config['address'])) {
            $config['address'] = new Address($config['address']);
        }
        if (!empty($config['history'])) {
            $config['history'] = new Address($config['history']);
        }
        $this->bindConfig($config);
    }

    /**
     * @return array
     */
    public function generateParamsArray()
    {
        $params = $this->generateNonObjectParamsArrayFromAttributes();
        $params['address'] = $this->address->generateNonObjectParamsArrayFromAttributes();
        $params['history'] = $this->history->generateNonObjectParamsArrayFromAttributes();

        return $params;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return CustomerHistory
     */
    public function getHistory()
    {
        return $this->history;
    }
}
