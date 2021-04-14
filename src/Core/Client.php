<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\CreateCheckoutResponse;
use Splintr\PhpSdk\Traits\ConfigTrait;
use Splintr\PhpSdk\Dependencies\GuzzleHttp\Client as GuzzleHttpClient;

class Client
{
    use ConfigTrait;

    protected $baseUrl;
    protected $storePublicKey;
    protected $storeSecret;
    protected $debugMode = false;
    protected $apiVersion = 'v1';

    /**
     * Should be a Http Client object
     *
     * @var null|GuzzleHttpClient
     */
    protected $transport = null;

    /**
     * Client constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        $this->bindConfig($config);

        $this->prepareTransport();
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Create a Splintr Checkout Request
     *
     * @return CreateCheckoutResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function createCheckoutRequest()
    {
        $apiResponse = $this->transport->request(
            'post',
            $this->getApiPath('merchant-estore/checkout')
        );

        /** @var CreateCheckoutResponse $createCheckoutResponse */
        $createCheckoutResponse = $this->generateApiResponse($apiResponse, CreateCheckoutResponse::class);
        return $createCheckoutResponse;
    }

    public function getApiPath($path)
    {
        return '/api/'.$this->apiVersion.'/'.ltrim($path, '/');
    }

    protected function prepareTransport()
    {
        $this->transport = new GuzzleHttpClient([
            'base_uri' => $this->getBaseUrl(),
        ]);
    }

    /**
     * Generate Api Response object from Api Response
     *
     * @param ResponseInterface $apiResponse
     * @param string $apiResponseClass
     *
     * @return ApiResponseInterface|null
     * @throws ApiErrorException
     */
    protected function generateApiResponse(ResponseInterface $apiResponse, $apiResponseClass)
    {
        if ($this->isSuccessfulStatusCode($apiResponse->getStatusCode())) {
            throw new ApiErrorException('Splintr API error. Please try again later!');
        }

        $apiResponse = new $apiResponseClass();
        $apiResponse->populateFromStream($apiResponse->getBody());

        return $apiResponse;
    }

    /**
     * Verify a status code is a successful one or not
     *
     * @param $statusCode
     *
     * @return bool
     */
    protected function isSuccessfulStatusCode($statusCode)
    {
        return 200 === (int) $statusCode;
    }
}
