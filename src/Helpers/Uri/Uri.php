<?php


namespace Splintr\PhpSdk\Helpers\Uri;

use Splintr\PhpSdk\Helpers\Uri\ParameterBag;
use RuntimeException;

class Uri
{
    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string|null
     */
    private $path = null;

    /**
     * @var ParameterBag
     */
    private $query;

    /**
     * @return self
     */
    public static function build()
    {
        return new self();
    }

    /**
     * @param  $uri
     *
     * @return self
     */
    public static function fromString($uri)
    {
        $uri = parse_url($uri);

        if (!is_array($uri)) {
            throw new RuntimeException("URI failed to parse using parse_url, please ensure is valid URL.");
        }

        $url = self::build()
                   ->addScheme($uri['scheme'])
                   ->addHost($uri['host']);

        if (isset($uri['path']) || !is_null($uri['path'])) {
            $url->addPath($uri['path']);
        }

        if (isset($uri['query']) || !is_null($uri['query'])) {
            $url->addQuery($uri['query']);
        }

        return $url;
    }

    /**
     * @param string $scheme
     *
     * @return self
     */
    public function addScheme($scheme)
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * @return string
     */
    public function scheme()
    {
        return $this->scheme;
    }

    /**
     * @param string $host
     *
     * @return self
     */
    public function addHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function host()
    {
        return $this->host;
    }

    /**
     * @param string|null $path
     *
     * @return self
     */
    public function addPath($path = null)
    {
        if (is_null($path)) {
            return $this;
        }

        $this->path = (substr($path, 0, 1) === '/') ? $path : "/{$path}";

        return $this;
    }

    /**
     * @return string|null
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return self
     */
    public function addQuery($path)
    {
        $this->query = ParameterBag::fromString($path);

        return $this;
    }

    /**
     * @return ParameterBag
     */
    public function query()
    {
        return $this->query;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString()
    {
        $url = "{$this->scheme}://{$this->host}";

        if (!is_null($this->path)) {
            $url .= "{$this->path}";
        }

        if (!empty($this->query->all())) {
            $collection = [];
            foreach ($this->query->all() as $key => $value) {
                $collection[] = "{$key}={$value}";
            }

            $url .= '?'.implode('&', $collection);
        }

        return $url;
    }
}