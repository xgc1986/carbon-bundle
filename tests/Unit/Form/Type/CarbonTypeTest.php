<?php
declare(strict_types=1);

namespace Tests\Unit\Form\Type;

use Faker\Factory;
use IntlDateFormatter;
use Mockery;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Xgc\CarbonBundle\Form\Type\CarbonType;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonTypeTest
 *
 * @package Tests\Unit\Form\Type
 */
class CarbonTypeTest extends TestCase
{

    public function testBuildForm()
    {
        /** @var FormBuilderInterface $builder */
        $builder = Mockery::mock(FormBuilderInterface::class);
        $builder->shouldReceive('addViewTransformer')
                ->andReturn($builder)
                ->getMock()
                ->shouldReceive('add')
                ->andReturn($builder)
                ->getMock()
                ->shouldReceive('addModelTransformer')
                ->andReturn($builder)
                ->getMock();

        $carbonType = new CarbonType();
        $carbonType->buildForm($builder, [
            'with_minutes'   => true,
            'with_seconds'   => true,
            'date_format'    => null,
            'format'         => null,
            'widget'         => null,
            'date_widget'    => null,
            'time_widget'    => null,
            'model_timezone' => null,
            'view_timezone'  => null,
            'input'          => 'array'
        ]);

        $carbonType->buildForm($builder, [
            'with_minutes'   => true,
            'with_seconds'   => true,
            'date_format'    => IntlDateFormatter::FULL,
            'format'         => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ',
            'widget'         => 'single_text',
            'date_widget'    => null,
            'time_widget'    => null,
            'model_timezone' => null,
            'view_timezone'  => null,
            'input'          => 'string'
        ]);

        $carbonType->buildForm($builder, [
            'with_minutes'   => true,
            'with_seconds'   => true,
            'date_format'    => IntlDateFormatter::FULL,
            'format'         => null,
            'widget'         => 'single_text',
            'date_widget'    => null,
            'time_widget'    => null,
            'model_timezone' => null,
            'view_timezone'  => null,
            'input'          => 'string'
        ]);

        $carbonType->buildForm($builder, [
            'with_minutes'   => true,
            'with_seconds'   => true,
            'date_format'    => IntlDateFormatter::FULL,
            'format'         => null,
            'widget'         => null,
            'date_widget'    => DateType::class,
            'time_widget'    => TimeType::class,
            'model_timezone' => Factory::create()->timezone,
            'view_timezone'  => null,
            'input'          => time()
        ]);

        self::assertTrue(true);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBuildFormFail()
    {
        $builder = Mockery::mock(FormBuilderInterface::class);
        $builder->shouldReceive('addViewTransformer')
                ->andReturn($builder)
                ->getMock()
                ->shouldReceive('add')
                ->andReturn($builder)
                ->getMock()
                ->shouldReceive('addModelTransformer')
                ->andReturn($builder)
                ->getMock();

        $carbonType = new CarbonType();
        $carbonType->buildForm($builder, [
            'with_minutes'   => true,
            'with_seconds'   => true,
            'date_format'    => 99,
            'format'         => 'yyyy-MM-dd\'T\'HH:mm:ssZZZZZ',
            'widget'         => 'single_text',
            'date_widget'    => null,
            'time_widget'    => null,
            'model_timezone' => null,
            'view_timezone'  => null,
            'input'          => 'string'
        ]);

        self::assertTrue(true);
    }
}
