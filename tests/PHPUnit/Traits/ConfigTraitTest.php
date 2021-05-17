<?php

namespace Splintr\PhpSdk\Tests\PHPUnit\Traits;

use Splintr\PhpSdk\Tests\BasePHPUnitTestCase;
use Splintr\PhpSdk\Traits\ConfigTrait;

/**
 * @coversDefaultClass ConfigTrait
 */
class ConfigTraitTest extends BasePHPUnitTestCase
{
    protected $mainObject;

    public function setUp(): void
    {
        $this->mainObject = $this->getObjectForTrait(ConfigTrait::class);
    }

    public function testBindConfig()
    {
        $obj = $this->mainObject;
        $obj->attr1 = null;

        $obj->bindConfig(
            [
                'attr1' => 'Attribute 1',
                'attr2' => 'Attribute 2',
            ]
        );

        $this->assertEquals($obj->attr1, 'Attribute 1', 'attr1 should have a correct value');
        $this->assertFalse(isset($obj->attr2), 'attr2 should not be set');
    }

    public function testGenerateNonObjectParamsArrayFromAttributes()
    {
        $obj = $this->mainObject;

        $tmpObject = new \stdClass();
        $tmpObject->someAttr = '123';

        $obj->attrOne = 'Attribute 1';
        $obj->attrTwo = $tmpObject;

        $arrTmp = $obj->generateNonObjectParamsArrayFromAttributes();

        $this->assertEquals($arrTmp['attr_one'], 'Attribute 1', 'attr_one should have a correct value');
        $this->assertFalse(isset($arrTmp['attr_two']), 'attr_two should not be set');
    }

    public function testSnakeEyesToCamelCase()
    {
        // This is protected method
        $snakeEyesToCamelCaseMethod = new \ReflectionMethod(
            get_class($this->mainObject),
            'snakeEyesToCamelCase'
        );
        $snakeEyesToCamelCaseMethod->setAccessible(true);
        $tmpStr = $snakeEyesToCamelCaseMethod->invoke(
            $this->mainObject,
            'snake_eyes_to_camel_case',
            false
        );
        $this->assertEquals(
            $tmpStr,
            'snakeEyesToCamelCase',
            'snake_eyes_to_camel_case should be transformed to snakeEyesToCamelCase'
        );

        $tmpStr = $snakeEyesToCamelCaseMethod->invoke(
            $this->mainObject,
            'snake_eyes_to_camel_case',
            true
        );
        $this->assertEquals(
            $tmpStr,
            'SnakeEyesToCamelCase',
            'snake_eyes_to_camel_case should be transformed to SnakeEyesToCamelCase'
        );
    }

    public function testCamelToSnakeEyes()
    {
        // This is protected method
        $snakeEyesToCamelCaseMethod = new \ReflectionMethod(
            get_class($this->mainObject),
            'camelCaseToSnakeEyes'
        );
        $snakeEyesToCamelCaseMethod->setAccessible(true);
        $tmpStr = $snakeEyesToCamelCaseMethod->invoke(
            $this->mainObject,
            'CamelCaseToSnakeEyes'
        );
        $this->assertEquals(
            $tmpStr,
            'camel_case_to_snake_eyes',
            'CamelCaseToSnakeEyes should be transformed to camel_case_to_snake_eyes'
        );

        $tmpStr = $snakeEyesToCamelCaseMethod->invoke(
            $this->mainObject,
            'CamelACaseToSnakeEyes'
        );
        $this->assertEquals(
            $tmpStr,
            'camel_acase_to_snake_eyes',
            'CamelCaseToSnakeEyes should be transformed to camel_case_to_snake_eyes'
        );
    }
}