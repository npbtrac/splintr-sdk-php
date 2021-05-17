<?php
declare(strict_types=1);

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
        $this->writeHeading('Test bindConfig() method');
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
}