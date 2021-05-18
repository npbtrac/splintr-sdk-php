<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\Inquiry;

class ViewInquiryResponse extends BaseApiResponse
{
    protected $data;

    /**
     * @return Inquiry
     */
    public function getInquiry()
    {
        return new Inquiry($this->data);
    }
}
