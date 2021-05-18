<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\InquiryCollection;

class ViewInquiryListResponse extends BaseApiResponse
{
    protected $data;

    /**
     * @return InquiryCollection
     */
    public function getInquiryList()
    {
        return new InquiryCollection($this->data);
    }
}