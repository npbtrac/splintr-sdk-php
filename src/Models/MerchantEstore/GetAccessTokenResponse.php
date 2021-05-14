<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;

class GetAccessTokenResponse extends BaseApiResponse
{
    protected $accessToken;
    protected $scopes;
    protected $expiresAt;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @return string
     */
    public function getExpiredAt()
    {
        return $this->expiresAt;
    }
}