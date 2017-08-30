<?php
declare(strict_types=1);

namespace Tests\Unit;

use Xgc\CarbonBundle\CarbonBundle;
use Xgc\CarbonBundle\DependencyInjection\CarbonExtension;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonBundleTest
 * @package Tests\Unit
 */
class CarbonBundleTest extends TestCase
{

    public function testGetExtension()
    {
        $bundle = new CarbonBundle();
        self::assertInstanceOf(CarbonExtension::class, $bundle->getContainerExtension());
        self::assertSame($bundle->getContainerExtension(), $bundle->getContainerExtension());
    }
}
