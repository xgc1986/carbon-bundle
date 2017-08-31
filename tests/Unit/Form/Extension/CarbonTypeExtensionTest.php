<?php
declare(strict_types=1);

namespace Tests\Unit\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Xgc\CarbonBundle\Form\Extension\CarbonTypeExtension;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonTypeExtensionTest
 * @package Tests\Unit\Form\Extension
 */
class CarbonTypeExtensionTest extends TestCase
{
    public function testWorks()
    {
        /** @var FormBuilderInterface $formBuilder */
        $formBuilder = \Mockery::mock(FormBuilderInterface::class)
                               ->shouldReceive('addModelTransformer')
                               ->andReturn()
                               ->getMock();

        $carbonTypeExtension = new CarbonTypeExtension();
        $carbonTypeExtension->buildForm($formBuilder, []);
        self::assertSame(DateTimeType::class, $carbonTypeExtension->getExtendedType());
    }
}
