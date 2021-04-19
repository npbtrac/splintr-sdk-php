<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
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
     * @return CreateCheckoutResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function createCheckoutRequest()
    {
        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::FORM_PARAMS => array(
                    'store_public_key' => $this->storePublicKey,
                    'product_type' => 'ibp',
                    'reference_id' => '123467',
                    'currency' => 'AED',
                    'callback_url' => 'https://yourstore.com/callback',
                    'redirect_url' => 'https://yourstore.com/redirect',
                    'amount' => '200.00',
                    'shipping_amount' => '10.00',
                    'tax_amount' => '0',
                    'discount_amount' => '0',
                    'description' => 'something about the order',
                    'customer' =>
                        array(
                            'email' => 'test@gmail.com',
                            'phone' => '1458778965',
                            'name' => 'Test Customer',
                            'address' =>
                                array(
                                    'line_1' => 'Business Bay',
                                    'city' => 'Dubai',
                                    'country' => 'AE',
                                ),
                            'history' =>
                                array(
                                    'gender' => 'F',
                                    'registered_since' => '2018-08-01',
                                    'dob' => '1993-01-01',
                                    'loyalty_score' => '7',
                                    'wishlist_count' => '2',
                                ),
                        ),
                    'items' =>
                        array(
                            0 =>
                                array(
                                    'quantity' => '1',
                                    'reference_id' => '123456',
                                    'title' => 'Shoe Pair',
                                    'unit_price' => '25',
                                    'image_url' => 'https://store.wordpress.com/2018/11/old-school-products.jpg',
                                    'product_url' => 'https://store.wordpress.com/2018/11/old-school-products.html',
                                    'description' => 'Good Pair of Shoes',
                                ),
                        ),
                    'orders_history' =>
                        array(
                            0 =>
                                array(
                                    'amount' => '500',
                                    'payment_method' => 'paymentgateway',
                                    'ordered' => '1',
                                    'captured' => '1',
                                    'shipped' => '1',
                                    'refunded' => '0',
                                    'description' => 'pair of goods',
                                    'purchased_at' => '2019-01-01',
                                    'items' =>
                                        array(
                                            0 =>
                                                array(
                                                    'title' => 'product 1',
                                                    'unit_price' => '18.56',
                                                ),
                                        ),
                                    'address' => 'somewhere in Dubai',
                                ),
                        ),
                ),
            ]
        );

        /** @var CreateCheckoutResponse $apiSplintrResponse */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, CreateCheckoutResponse::class);
        return $apiSplintrResponse;
    }

    public function buildApiPath($path)
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
        return 200 === (int) $statusCode;
    }
}
