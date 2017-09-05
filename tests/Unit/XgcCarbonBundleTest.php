<?php
declare(strict_types=1);

namespace Tests\Unit;

use Xgc\CarbonBundle\DependencyInjection\XgcCarbonExtension;
use Xgc\CarbonBundle\Test\TestCase;
use Xgc\CarbonBundle\XgcCarbonBundle;

/**
 * Class XgcCarbonBundleTest
 * @package Tests\Unit
 */
class XgcCarbonBundleTest extends TestCase
{
    public function testGetExtension()
    {
        $bundle = new XgcCarbonBundle();
        self::assertInstanceOf(XgcCarbonExtension::class, $bundle->getExtension());
    }
}
