<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Dependencies\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\CreateCheckoutRequestRequest;
use Splintr\PhpSdk\Models\CreateCheckoutRequestResponse;
use Splintr\PhpSdk\Models\GetAccessTokenRequest;
use Splintr\PhpSdk\Models\GetAccessTokenResponse;
use Splintr\PhpSdk\Models\GetRequestByTokenRequest;
use Splintr\PhpSdk\Models\GetRequestByTokenResponse;
use Splintr\PhpSdk\Models\Order;
use Splintr\PhpSdk\Traits\ConfigTrait;
use Splintr\PhpSdk\Dependencies\GuzzleHttp\Client as GuzzleHttpClient;

class Client
{
    use ConfigTrait;

    protected $baseUrl;
    protected $storeKey;
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
     * Build up a request object for Create Checkout Request action
     *
     * @param Order $order
     * @return CreateCheckoutRequestRequest
     */
    public function generateCreateCheckoutRequestRequest(Order $order)
    {
        return new CreateCheckoutRequestRequest([
            'order' => $order,
            'storePublicKey' => $this->storePublicKey,
        ]);
    }

    /**
     * Create a Splintr Checkout Request
     *
     * @param CreateCheckoutRequestRequest $createCheckoutRequestRequest
     *
     * @return CreateCheckoutRequestResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function createCheckoutRequest(CreateCheckoutRequestRequest $createCheckoutRequestRequest)
    {
        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::FORM_PARAMS => $createCheckoutRequestRequest->generateRequestParams(),
            ]
        );

        /** @var CreateCheckoutRequestResponse $apiSplintrResponse */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, CreateCheckoutRequestResponse::class);
        return $apiSplintrResponse;
    }

    /**
     * @return GetAccessTokenRequest
     */
    public function generateGetAccessTokenRequest()
    {
        return new GetAccessTokenRequest([
            'storeKey' => $this->storeKey,
            'storeSecret' => $this->storeSecret,
        ]);
    }

    /**
     * @param GetAccessTokenRequest $getAccessTokenRequest
     * @return GetAccessTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(GetAccessTokenRequest $getAccessTokenRequest)
    {
        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/get-access-token'),
            [
                RequestOptions::FORM_PARAMS => $getAccessTokenRequest->generateRequestParams(),
            ]
        );

        /** @var GetAccessTokenResponse $apiSplintrResponse */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetAccessTokenResponse::class);
        return $apiSplintrResponse;
    }

    /**
     * @param $checkoutToken
     * @return GetRequestByTokenRequest
     */
    public function generateGetRequestByTokenRequest($checkoutToken)
    {
        return new GetRequestByTokenRequest([
            'checkoutToken' => $checkoutToken,
        ]);
    }

    /**
     * @param GetRequestByTokenRequest $getRequestByTokenRequest
     * @return GetRequestByTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getRequestByToken(GetRequestByTokenRequest $getRequestByTokenRequest)
    {
        dump($getRequestByTokenRequest->generateRequestParams());
        $apiResponse = $this->transport->request(
            'get',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::QUERY => $getRequestByTokenRequest->generateRequestParams(),
            ]
        );

        /** @var GetRequestByTokenResponse $apiSplintrResponse */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetRequestByTokenResponse::class);
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

        /** @var ApiResponseInterface $apiSplintrResponse */
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
