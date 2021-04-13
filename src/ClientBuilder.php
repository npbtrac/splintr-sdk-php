<?php

namespace Splintr\PhpSdk;

use Splintr\PhpSdk\Helpers\Uri\Uri;
use Psr\Http\Client\ClientInterface;

class ClientBuilder
{
    /**
     * @var Uri|null
     */
    protected $uri;

    /**
     * @var ClientInterface|null
     */
    protected $transport;

    /**
     * @var StrategyInterface|null
     */
    protected $strategy;

    /**
     * @var ContainerInterface|null
     */
    protected $factory;

    /**
     * ClientBuilder constructor.
     *
     * @param Uri|null                $uri
     * @param ClientInterface|null         $transport
     * @param StrategyInterface|null  $strategy
     * @param ContainerInterface|null $factory
     */
    public function __construct(
        Uri $uri = null,
        HttpClient $transport = null,
        StrategyInterface $strategy = null,
        ContainerInterface $factory = null
    ) {
        $this->setUri($uri);
        $this->setTransport($transport);
        $this->setStrategy($strategy);
        $this->setFactory($factory);
    }

    /**
     * @param Uri|null $uri
     */
    public function setUri(?Uri $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return Uri
     */
    public function uri(): Uri
    {
        return $this->uri;
    }

    /**
     * @param ClientInterface|null $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * @return ClientInterface
     */
    public function transport(): HttpClient
    {
        return $this->transport;
    }

    /**
     * @param StrategyInterface|null $strategy
     */
    public function setStrategy($strategy)
    {
        if (is_null($strategy)) {
            $this->strategy = new NullStrategy();

            return;
        }
        $this->strategy = $strategy;
    }

    /**
     * @return StrategyInterface
     */
    public function strategy(): StrategyInterface
    {
        return $this->strategy;
    }

    /**
     * @param ContainerInterface|null $factory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return ContainerInterface
     */
    public function factory(): ContainerInterface
    {
        return $this->factory;
    }
}