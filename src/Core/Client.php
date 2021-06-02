<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdkLib\Psr\Http\Message\ResponseInterface;
use Splintr\PhpSdkLib\GuzzleHttp\Client as GuzzleHttpClient;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Traits\ConfigTrait;

class Client
{
    use ConfigTrait;
    use ClientMerchantEstoreTrait;
    use ClientAfterCheckoutTrait;

    const PROD_APP_URL = 'https://app.splintr.com';

    protected $appUrl;
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

    protected $urlMappingApiApp = [
        'https://linked.splintr.xyz' => 'https://react.splintr.xyz',
        'https://qa-api.splintrit.com' => 'https://qa-app.splintr.com',
        'https://sandbox-api.splintrit.com' => 'https://sandbox.splintr.com',
    ];

    /**
     * Client constructor.
     *
     * @param $config
     */
    public function __construct($config = [])
    {
        $this->bindConfig($config);
        $this->appUrl = $this->buildAppUrl();

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
     * Get App URL
     *
     * @return mixed
     */
    public function getAppUrl()
    {
        return $this->appUrl;
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
        return 200 === (int) $statusCode;
    }

    /**
     * Build App URL from API URL using a mapping array
     *
     * @return string
     */
    protected function buildAppUrl()
    {
        $apiUrl = trim($this->baseUrl);
        return isset($this->urlMappingApiApp[$apiUrl])
            ? $this->urlMappingApiApp[$apiUrl]
            : static::PROD_APP_URL;
    }
}
