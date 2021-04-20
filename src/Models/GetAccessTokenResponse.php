<?php


namespace Splintr\PhpSdk\Models;

class GetAccessTokenResponse extends BaseApiResponse
{
    protected $accessToken;
    protected $scopes;
    protected $expiresAt;

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function getExpiredAt()
    {
        return $this->expiresAt;
    }
}