<?php


namespace Splintr\PhpSdk\Models;

use Splintr\PhpSdk\Core\ApiResponseInterface;
use Splintr\PhpSdkLib\Psr\Http\Message\StreamInterface;
use Splintr\PhpSdk\Traits\ConfigTrait;

abstract class BaseApiResponse implements ApiResponseInterface
{
    use ConfigTrait;

    protected $success;
    protected $errorCode;
    protected $message;
    protected $data;
    protected $rawContent = null;

    /**
     * Inherited
     *
     * @inheritDoc
     */
    public function isSuccess()
    {
        return !!$this->success;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }

    /**
     * Inherited
     *
     * @inheritDoc
     */
    public function populateFromStream(StreamInterface $responseStream)
    {
        if ($responseStream instanceof StreamInterface) {
            $this->rawContent = $responseStream->getContents();

            if ($this->rawContent) {
                $jsonContent = json_decode($this->rawContent, true);
                // Mainly for binding `data` field
                $this->bindConfig($jsonContent);

                // Use `data` to bind all necessary attributes
                $this->bindConfig($this->data);
            }
        }
    }
}
