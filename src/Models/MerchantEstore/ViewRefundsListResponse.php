<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\RefundCollection;

class ViewRefundsListResponse extends BaseApiResponse
{
    protected $count;
    protected $refunds;

    public function getCount()
    {
        return $this->count;
    }

    public function getRefunds()
    {
        return new RefundCollection($this->refunds);
    }
}