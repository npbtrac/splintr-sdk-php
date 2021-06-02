<?php


namespace Splintr\PhpSdk\Core;

/**
 * Trait ClientAfterCheckoutTrait
 *
 * @package Splintr\PhpSdk\Core
 */
trait ClientAfterCheckoutTrait
{

    /**
     * Get callback payload
     *
     * @return mixed
     */
    public function getCallbackPayload()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * @return mixed
     */
    public function getInquiryIdFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['inquiry_id'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getDecisionFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['decision'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getStatusFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['status'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getRequestedAmountFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['requested_amount'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getApprovedAmountFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['approved_amount'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getConvertedFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['converted'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getOrderIdFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['order_id'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getReferenceIdFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['reference_id'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getProductChoiceFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['product_choice'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getCustomerFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['customer'];
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getItemsFromCallbackPayload()
    {
        $callbackPayload = $this->getCallbackPayload();
        if (!empty($callbackPayload)) {
            return $callbackPayload['items'];
        }

        return null;
    }

    /**
     * @param $referenceId
     *
     * @return bool
     */
    public function verifyCallbackRequest($referenceId)
    {
        $inquiryId = $this->getInquiryIdFromCallbackPayload();
        $viewInquiryRequest = $this->generateViewInquiryRequest($inquiryId);
        $viewInquiryResponse = $this->viewInquiry($viewInquiryRequest);

        if ($viewInquiryResponse->isSuccess()) {
            return $inquiryId === $viewInquiryResponse->getInquiry()->getInquiryId()
                   && $referenceId === $viewInquiryResponse->getInquiry()->getReferenceId();
        }

        return false;
    }

    /**
     * @param $referenceId
     *
     * @return bool
     */
    public function verifyCallbackInquiryApproved($referenceId)
    {
        $decision = $this->getDecisionFromCallbackPayload();

        return $this->verifyCallbackRequest($referenceId)
               && $this->isDecisionApproved($decision);
    }

    /**
     * @param $inquiryId
     *
     * @return bool
     */
    public function isRedirectTransactionSuccess($inquiryId)
    {
        $viewInquiryRequest = $this->generateViewInquiryRequest($inquiryId);
        $viewInquiryResponse = $this->viewInquiry($viewInquiryRequest);

        if ($viewInquiryResponse->isSuccess()) {
            return $this->isDecisionApproved($viewInquiryResponse->getInquiry()->getDecision());
        }

        return false;
    }

    /**
     * Check if an Inquiry has 'Approved' decision or not
     *
     * @param $decision
     *
     * @return bool
     */
    protected function isDecisionApproved($decision)
    {
        return 'Approved' === $decision;
    }
}
