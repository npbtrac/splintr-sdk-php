<?php


namespace Splintr\PhpSdk\Models\MerchantEstore;

use Splintr\PhpSdk\Models\BaseApiResponse;

class CreateCheckoutRequestResponse extends BaseApiResponse
{
    protected $token;
    protected $expiry;

    protected $appUrl;

    /**
     * @param string $appUrl
     *
     * @return void
     */
    public function setAppUrl($appUrl)
    {
        $this->appUrl = trim(trim($appUrl), '\/');
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @return string
     */
    public function getAppUrl()
    {
        return $this->appUrl;
    }

    /**
     * @return string
     */
    public function getCheckoutUrl()
    {
        if ($this->getToken() && $this->appUrl) {
            return $this->appUrl.'/checkout-process/'.$this->getToken();
        }

        return null;
    }
}
