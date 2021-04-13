<?php


namespace Splintr\PhpSdk\Helpers\Uri;


class ParameterBag
{
    /**
     * The parameters in our bag
     *
     * @var array
     */
    protected $parameters;

    /**
     * The Parameter Bag Constructor
     *
     * @param array $parameters
     *
     * @return void
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Check to see if our bad contains a parameter
     *
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * Get an item out of our bag
     *
     * @param string $key
     *
     * @return  mixed
     */
    public function get($key)
    {
        return $this->parameters[$key];
    }

    /**
     * Set an item in our bag (this will over write the current value)
     *
     * @param string $key
     * @param mixed $value
     *
     * @return self
     */
    public function set($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    /**
     * Remove an item from our bag
     *
     * @param string $key
     *
     * @return self
     */
    public function remove($key)
    {
        unset($this->parameters[$key]);

        return $this;
    }

    /**
     * Get all items from our bag
     *
     * @return  array
     */
    public function all()
    {
        return $this->parameters;
    }

    /**
     * Create a new bag from a string
     *
     * @param string $attributes
     * @param string $delimiter
     *
     * @return  self
     */
    public static function fromString($attributes, $delimiter = '&')
    {
        return new self(
            self::mapToAssoc(
                explode($delimiter, $attributes),
                function ($keyValue) {
                    $parts = explode('=', $keyValue, 2);

                    return count($parts) === 2 ? $parts : [$parts[0], null];
                }
            )
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @param $items
     * @param callable $callback
     *
     * @return mixed|null
     */
    private static function mapToAssoc($items, callable $callback)
    {
        return array_reduce(
            $items,
            function (array $assoc, $item) use ($callback) {
                list($key, $value) = $callback($item);
                $assoc[$key] = $value;

                return $assoc;
            },
            []
        );
    }
}
