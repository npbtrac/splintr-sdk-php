<?php

namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\GuzzleHttp\RequestOptions;
use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestRequest;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenResponse;
use Splintr\PhpSdk\Models\Order;

/**
 * Trait ClientMerchantEstore
 *
 * @package Splintr\PhpSdk\Core
 */
trait ClientMerchantEstoreTrait
{
    /**
     * Build up a request object for Create Checkout Request action
     *
     * @param Order $order
     * @return CreateCheckoutRequestRequest
     */
    public function generateCreateCheckoutRequestRequest(Order $order)
    {
        /** @var Client $this */
        return new CreateCheckoutRequestRequest([
            'order' => $order,
            'storePublicKey' => $this->storePublicKey,
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
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
        /** @var Client $this */
        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::FORM_PARAMS => $createCheckoutRequestRequest->generateRequestParams(),
            ]
        );

        /** @var CreateCheckoutRequestResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, CreateCheckoutRequestResponse::class);
        return $apiSplintrResponse;
    }

    /**
     * @return GetAccessTokenRequest
     */
    public function generateGetAccessTokenRequest()
    {
        /** @var Client $this */
        return new GetAccessTokenRequest([
            'storeKey' => $this->storeKey,
            'storeSecret' => $this->storeSecret,
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param GetAccessTokenRequest $getAccessTokenRequest
     * @return GetAccessTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(GetAccessTokenRequest $getAccessTokenRequest)
    {
        /** @var Client $this */
        $apiResponse = $this->transport->request(
            'post',
            $this->buildApiPath('merchant-estore/get-access-token'),
            [
                RequestOptions::FORM_PARAMS => $getAccessTokenRequest->generateRequestParams(),
            ]
        );

        /** @var GetAccessTokenResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetAccessTokenResponse::class);
        return $apiSplintrResponse;
    }

    /**
     * @param $checkoutToken
     * @return GetRequestByTokenRequest
     */
    public function generateGetRequestByTokenRequest($checkoutToken)
    {
        /** @var Client $this */
        return new GetRequestByTokenRequest([
            'checkoutToken' => $checkoutToken,
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param GetRequestByTokenRequest $getRequestByTokenRequest
     * @return GetRequestByTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getRequestByToken(GetRequestByTokenRequest $getRequestByTokenRequest)
    {
        /** @var Client $this */
        $apiResponse = $this->transport->request(
            'get',
            $this->buildApiPath('merchant-estore/checkout'),
            [
                RequestOptions::QUERY => $getRequestByTokenRequest->generateRequestParams(),
            ]
        );

        /** @var GetRequestByTokenResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetRequestByTokenResponse::class);
        return $apiSplintrResponse;
    }
}
