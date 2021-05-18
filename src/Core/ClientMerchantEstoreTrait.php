<?php

namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Exceptions\ApiErrorException;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestRequest;
use Splintr\PhpSdk\Models\MerchantEstore\CreateCheckoutRequestResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetAccessTokenResponse;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenRequest;
use Splintr\PhpSdk\Models\MerchantEstore\GetRequestByTokenResponse;
use Splintr\PhpSdk\Models\MerchantEstore\InitiateRefundRequest;
use Splintr\PhpSdk\Models\MerchantEstore\InitiateRefundResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewInquiryListRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewInquiryListResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewInquiryRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewInquiryResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewOrderListRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewOrderListResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewOrderRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewOrderResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewRefundsListRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewRefundsListResponse;
use Splintr\PhpSdk\Models\MerchantEstore\ViewSettlementsListRequest;
use Splintr\PhpSdk\Models\MerchantEstore\ViewSettlementsListResponse;
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
     *
     * @return CreateCheckoutRequestRequest
     */
    public function generateCreateCheckoutRequestRequest(Order $order)
    {
        /** @var Client $this */
        return new CreateCheckoutRequestRequest([
            'order' => $order,
            'storePublicKey' => $this->storePublicKey,
            'appUrl' => $this->appUrl,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/checkout'),
            'apiMethod' => 'post',
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
        $apiResponse = $createCheckoutRequestRequest->requestApi($this->transport);

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
            'apiEndpoint' => $this->buildApiPath('merchant-estore/get-access-token'),
            'apiMethod' => 'post',
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param GetAccessTokenRequest $getAccessTokenRequest
     *
     * @return GetAccessTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(GetAccessTokenRequest $getAccessTokenRequest)
    {
        $apiResponse = $getAccessTokenRequest->requestApi($this->transport);

        /** @var GetAccessTokenResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetAccessTokenResponse::class);

        return $apiSplintrResponse;
    }

    /**
     * @param $checkoutToken
     *
     * @return GetRequestByTokenRequest
     */
    public function generateGetRequestByTokenRequest($checkoutToken)
    {
        /** @var Client $this */
        return new GetRequestByTokenRequest([
            'checkoutToken' => $checkoutToken,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/checkout'),
            'apiMethod' => 'get',
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param GetRequestByTokenRequest $getRequestByTokenRequest
     *
     * @return GetRequestByTokenResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function getRequestByToken(GetRequestByTokenRequest $getRequestByTokenRequest)
    {
        $apiResponse = $getRequestByTokenRequest->requestApi($this->transport);

        /** @var GetRequestByTokenResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, GetRequestByTokenResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewInquiryListRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewInquiryListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewInquiryListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/inquiry-list/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewInquiryListRequest $generateViewInquiryListRequest
     *
     * @return ApiResponseInterface|ViewInquiryListResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewInquiryList(ViewInquiryListRequest $generateViewInquiryListRequest)
    {
        $apiResponse = $generateViewInquiryListRequest->requestApi($this->transport);

        /** @var ViewInquiryListResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewInquiryListResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $inquiryId
     *
     * @return ViewInquiryRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewInquiryRequest($inquiryId)
    {
        /** @var Client $this */
        return new ViewInquiryRequest([
            'inquiryId' => $inquiryId,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/inquiry/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewInquiryRequest $generateViewInquiryRequest
     *
     * @return ApiResponseInterface|ViewInquiryResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewInquiry(ViewInquiryRequest $generateViewInquiryRequest)
    {
        $apiResponse = $generateViewInquiryRequest->requestApi($this->transport);

        /** @var ViewInquiryResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewInquiryResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     * @param $status
     *
     * @return ViewOrderListRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewOrderListRequest($startDate, $endDate, $size, $from, $status)
    {
        /** @var Client $this */
        return new ViewOrderListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
            'status' => $status,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/order-list/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewOrderListRequest $generateViewOrderListRequest
     *
     * @return ApiResponseInterface|ViewInquiryListResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewOrderList(ViewOrderListRequest $generateViewOrderListRequest)
    {
        $apiResponse = $generateViewOrderListRequest->requestApi($this->transport);

        /** @var ViewOrderListResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewOrderListResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $orderId
     *
     * @return ViewOrderRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewOrderRequest($orderId)
    {
        /** @var Client $this */
        return new ViewOrderRequest([
            'orderId' => $orderId,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/order/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewOrderRequest $generateViewOrderRequest
     *
     * @return ApiResponseInterface|ViewOrderResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewOrder(ViewOrderRequest $generateViewOrderRequest)
    {
        $apiResponse = $generateViewOrderRequest->requestApi($this->transport);

        /** @var ViewOrderResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewOrderResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewRefundsListRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewRefundsListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewRefundsListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/refunds-list/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewRefundsListRequest $generateViewRefundsListRequest
     *
     * @return ApiResponseInterface|ViewRefundsListResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewRefundsList(ViewRefundsListRequest $generateViewRefundsListRequest)
    {
        $apiResponse = $generateViewRefundsListRequest->requestApi($this->transport);

        /** @var ViewRefundsListResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewRefundsListResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewSettlementsListRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateViewSettlementsListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewSettlementsListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/settlements-list/view'),
            'apiMethod' => 'get',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param ViewSettlementsListRequest $generateViewSettlementsListRequest
     *
     * @return ApiResponseInterface|ViewRefundsListResponse|null
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function viewSettlementsList(ViewSettlementsListRequest $generateViewSettlementsListRequest)
    {
        $apiResponse = $generateViewSettlementsListRequest->requestApi($this->transport);
        /** @var ViewSettlementsListResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewSettlementsListResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * @param $orderId
     * @param $amount
     * @param $reason
     *
     * @return InitiateRefundRequest
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function generateInitiateRefundRequest($orderId, $amount, $reason)
    {
        /** @var Client $this */
        return new InitiateRefundRequest([
            'orderId' => $orderId,
            'amount' => $amount,
            'reason' => $reason,
            'apiEndpoint' => $this->buildApiPath('merchant-estore/refund/initiate'),
            'apiMethod' => 'post',
            'apiHeaders' => $this->generateAuthHeader(),
        ]);
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * Initiate a Refund request
     *
     * @param InitiateRefundRequest $generateInitiateRefundRequest
     *
     * @return InitiateRefundResponse
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    public function initiateRefund(InitiateRefundRequest $generateInitiateRefundRequest)
    {
        $apiResponse = $generateInitiateRefundRequest->requestApi($this->transport);

        /** @var InitiateRefundResponse $apiSplintrResponse */
        /** @var Client $this */
        $apiSplintrResponse = $this->generateApiResponse($apiResponse, InitiateRefundResponse::class);

        return $apiSplintrResponse;
    }

    /** @noinspection PhpFullyQualifiedNameUsageInspection */
    /**
     * Generate the Bearer Authorization for header
     *
     * @return string[]
     * @throws ApiErrorException
     * @throws \Splintr\PhpSdk\Dependencies\GuzzleHttp\Exception\GuzzleException
     */
    protected function generateAuthHeader()
    {
        return [
            'Authorization' => 'Bearer '.$this->getAccessToken(
                $this->generateGetAccessTokenRequest()
            )->getAccessToken(),
        ];
    }
}
