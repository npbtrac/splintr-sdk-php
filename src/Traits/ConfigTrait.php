<?php


namespace Splintr\PhpSdk\Traits;

trait ConfigTrait
{
    /**
     * Bind an array of key value pairs to object properties
     *
     * @param array $config
     */
    public function bindConfig($config)
    {
        foreach ((array) $config as $attrName => $attrValue) {
            if (property_exists($this, $attrName)) {
                $this->$attrName = $attrValue;
            }

            $attrName = $this->snakeEyesToCamelCase($attrName);
            if (property_exists($this, $attrName)) {
                $this->$attrName = $attrValue;
            }
        }
    }

    /**
     * @return array
     */
    public function generateNonObjectParamsArrayFromAttributes()
    {
        $params = [];

        $attributes = get_object_vars($this);

        foreach ($attributes as $attributeKey => $attributeValue) {
            if (!is_object($attributeValue)) {
                $params[$this->camelCaseToSnakeEyes($attributeKey)] = $attributeValue;
            }
        }

        return $params;
    }

    /**
     * Convert Snake_Eyes string to CamelCase one
     *
     * @param $string
     * @param bool $capitalizeFirstCharacter
     *
     * @return string|string[]]
     */
    protected function snakeEyesToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    /**
     * Convert CamelCase string to Snake_Eyes one
     *
     * @param $string
     * @param string $us
     *
     * @return string
     */
    protected function camelCaseToSnakeEyes($string, $us = '_')
    {
        return strtolower(preg_replace(
            '/(?<=\d)(?=[A-Za-z])|(?<=[A-Za-z])(?=\d)|(?<=[a-z])(?=[A-Z])/',
            $us,
            $string
        ));
    }
}
