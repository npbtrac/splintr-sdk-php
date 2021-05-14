<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\Inquiry;

class ViewInquiryResponse extends BaseApiResponse
{
    protected $inquiry = null;

    public function getInquiry()
    {
        if (empty($this->inquiry)) {
            $this->inquiry = new Inquiry($this->getData());
        }

        return $this->inquiry;
    }
}
