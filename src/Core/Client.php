<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Dependencies\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestRequest;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenResponse;
use Splintr\PhpSdk\Models\Order;
use Splintr\PhpSdk\Traits\ConfigTrait;
use Splintr\PhpSdk\Dependencies\GuzzleHttp\Client as GuzzleHttpClient;

class Client
{
    use ConfigTrait;
    use ClientMerchantEstoreTrait;

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
