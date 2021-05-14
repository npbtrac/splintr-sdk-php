<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\InquiryCollection;

class ViewInquiryListResponse extends BaseApiResponse
{
    protected $data;

    public function getInquiryList()
    {
        $this->data = new InquiryCollection($this->getData());
        return $this->data;
    }
}