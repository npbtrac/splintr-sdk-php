<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiRequest;

class GetAccessTokenRequest extends BaseApiRequest
{
    protected $storeKey;
    protected $storeSecret;
}
