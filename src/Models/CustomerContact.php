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

    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    public function generateParamsArray()
    {
        $params = $this->generateNonObjectParamsArrayFromAttributes();
        $params['address'] = $this->address->generateNonObjectParamsArrayFromAttributes();
        $params['history'] = $this->history->generateNonObjectParamsArrayFromAttributes();

        return $params;
    }
}
