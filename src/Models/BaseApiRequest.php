<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Traits\ConfigTrait;
use Splintr\PhpSdk\Dependencies\GuzzleHttp\Client as GuzzleHttpClient;

abstract class BaseApiRequest
{
    use ConfigTrait;

    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * @var string
     */
    protected $apiMethod;

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

    public function getApiEndpoint()
    {
        return $this->apiEndpoint;
    }

    public function getApiMethod()
    {
        return $this->apiMethod;
    }

    public function getRequestOption()
    {
        switch (strtolower($this->getApiMethod())) {
            case 'post':
                return RequestOptions::FORM_PARAMS;
            default:
                return RequestOptions::QUERY;
        }
    }

    /**
     * @param GuzzleHttpClient $transport
     *
     * @return ResponseInterface
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function requestApi(GuzzleHttpClient $transport)
    {
        return $transport->request(
            $this->getApiMethod(),
            $this->getApiEndpoint(),
            [
                $this->getRequestOption() => $this->generateRequestParams(),
            ]
        );
    }
}