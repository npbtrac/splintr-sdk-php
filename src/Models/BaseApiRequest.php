<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

abstract class BaseApiRequest
{
    use ConfigTrait;

    /**
     * BaseApiRequest constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    /**
     * @return array
     */
    public function generateRequestParams()
    {
        $params = [];
        $params = array_merge($params, $this->generateNonObjectParamsArrayFromAttributes());

        return $params;
    }
}