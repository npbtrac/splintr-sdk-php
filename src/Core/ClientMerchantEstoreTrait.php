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
     *
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
     *
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
     *
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

    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewInquiryListRequest
     */
    public function generateViewInquiryListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewInquiryListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/inquiry-list/view'),
                [
                    RequestOptions::QUERY => $generateViewInquiryListRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewInquiryListResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewInquiryListResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $inquiryId
     *
     * @return ViewInquiryRequest
     */
    public function generateViewInquiryRequest($inquiryId)
    {
        /** @var Client $this */
        return new ViewInquiryRequest([
            'inquiryId' => $inquiryId,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/inquiry/view'),
                [
                    RequestOptions::QUERY => $generateViewInquiryRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewInquiryResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewInquiryResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     * @param $status
     *
     * @return ViewOrderListRequest
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/order-list/view'),
                [
                    RequestOptions::QUERY => $generateViewOrderListRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewOrderListResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewOrderListResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $orderId
     *
     * @return ViewOrderRequest
     */
    public function generateViewOrderRequest($orderId)
    {
        /** @var Client $this */
        return new ViewOrderRequest([
            'orderId' => $orderId,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/order/view'),
                [
                    RequestOptions::QUERY => $generateViewOrderRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewOrderResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewOrderResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewRefundsListRequest
     */
    public function generateViewRefundsListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewRefundsListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/refunds-list/view'),
                [
                    RequestOptions::QUERY => $generateViewRefundsListRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewRefundsListResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewRefundsListResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $startDate
     * @param $endDate
     * @param $size
     * @param $from
     *
     * @return ViewSettlementsListRequest
     */
    public function generateViewSettlementsListRequest($startDate, $endDate, $size, $from)
    {
        /** @var Client $this */
        return new ViewSettlementsListRequest([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'size' => $size,
            'from' => $from,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'get',
                $this->buildApiPath('merchant-estore/settlements-list/view'),
                [
                    RequestOptions::QUERY => $generateViewSettlementsListRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );
            /** @var ViewSettlementsListResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, ViewSettlementsListResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }

    /**
     * @param $orderId
     * @param $amount
     * @param $reason
     *
     * @return InitiateRefundRequest
     */
    public function generateInitiateRefundRequest($orderId, $amount, $reason)
    {
        /** @var Client $this */
        return new InitiateRefundRequest([
            'orderId' => $orderId,
            'amount' => $amount,
            'reason' => $reason,
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
        $getAccessTokenRequest = $this->generateGetAccessTokenRequest();
        $getAccessTokenResponse = $this->getAccessToken($getAccessTokenRequest);
        if (!empty($getAccessTokenResponse->getAccessToken())) {
            $accessToken = $getAccessTokenResponse->getAccessToken();
            /** @var Client $this */
            $apiResponse = $this->transport->request(
                'post',
                $this->buildApiPath('merchant-estore/refund/initiate'),
                [
                    RequestOptions::FORM_PARAMS => $generateInitiateRefundRequest->generateRequestParams(),
                    RequestOptions::HEADERS => [
                        'Authorization' => 'Bearer '.$accessToken,
                    ],
                ]
            );

            /** @var InitiateRefundResponse $apiSplintrResponse */
            /** @var Client $this */
            $apiSplintrResponse = $this->generateApiResponse($apiResponse, InitiateRefundResponse::class);

            return $apiSplintrResponse;
        } else {
            return null;
        }
    }
}
