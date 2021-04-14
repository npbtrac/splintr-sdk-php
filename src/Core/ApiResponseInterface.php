<?php


namespace Splintr\PhpSdk\Core;

use Splintr\PhpSdk\Dependencies\Psr\Http\Message\StreamInterface;

interface ApiResponseInterface
{
    /**
     * Check if the response is a successful one
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Populate the Api Response object from response stream
     *
     * @param StreamInterface $responseStream
     *
     * @return void
     */
    public function populateFromStream(StreamInterface $responseStream);
}
