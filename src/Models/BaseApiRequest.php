<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Traits\ConfigTrait;

abstract class BaseApiRequest
{
    use ConfigTrait;

    public function __construct($config)
    {
        $this->bindConfig($config);
    }

    public function generateRequestParams()
    {
        $params = [];
        $params = array_merge($params, $this->generateNonObjectParamsArrayFromAttributes());

        return $params;
    }
}