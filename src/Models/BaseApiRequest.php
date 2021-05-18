<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdkLib\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdkLib\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Traits\ConfigTrait;
use Splintr\PhpSdkLib\GuzzleHttp\Client as GuzzleHttpClient;

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
     * @var string
     */
    protected $apiHeaders;

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

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param GuzzleHttpClient $transport
     *
     * @return ResponseInterface
     * @throws \Splintr\PhpSdkLib\GuzzleHttp\Exception\GuzzleException
     */
    public function requestApi(GuzzleHttpClient $transport)
    {
        $options = [
            $this->getRequestOption() => $this->generateRequestParams(),
        ];
        if (!empty($this->apiHeaders)) {
            $options = array_merge($options, [
                RequestOptions::HEADERS => $this->apiHeaders,
            ]);
        }

        return $transport->request(
            $this->getApiMethod(),
            $this->getApiEndpoint(),
            $options
        );
    }
}