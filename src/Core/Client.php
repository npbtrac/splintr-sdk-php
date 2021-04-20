<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Dependencies\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\CreateCheckoutResponse;
use Splintr\PhpSdk\Models\Order;
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

    /**
     * Get Base URL of API
     *
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Create a Splintr Checkout Request
     *
     * @param Order $order
     *
     * @return CreateCheckoutResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function createCheckoutRequest(Order $order)
    {
        $requestParams = $order->generateRequestParams();
        $requestParams['store_public_key'] = $this->storePublicKey;

        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::FORM_PARAMS => $requestParams,
            ]
        );

        /** @var CreateCheckoutResponse $apiSplintrResponse */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, CreateCheckoutResponse::class);
        return $apiSplintrResponse;
    }

    /**
     * Generate Api path
     *
     * @param $path
     * @return string
     */
    public function buildApiPath($path)
    {
        return '/api/' . $this->apiVersion . '/' . ltrim($path, '/');
    }

    /**
     * Prepare the transport layer
     */
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
        if (!$this->isSuccessfulStatusCode($apiResponse->getStatusCode())) {
            throw new ApiErrorException('Splintr API error. Please try again later!');
        }

        $apiSplintrResponse = new $apiResponseClass();
        $apiSplintrResponse->populateFromStream($apiResponse->getBody());

        return $apiSplintrResponse;
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
        return 200 === (int)$statusCode;
    }
}
