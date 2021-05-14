<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;
use Splintr\PhpSdk\Models\SettlementCollection;

class ViewSettlementsListResponse extends BaseApiResponse
{
    protected $count;
    protected $settlements;

    public function getCount()
    {
        return $this->count;
    }

    public function getSettlements()
    {
        return new SettlementCollection($this->settlements);
    }
}