<?php
declare(strict_types=1);

namespace Tests\Unit\Form\DataTransformer;

use Faker\Factory;
use Xgc\CarbonBundle\Form\DataTransformer\CarbonToDateTimeTransformer;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonToDateTimeTransformerTest
 * @package Tests\Unit\Form\DataTransformer
 */
class CarbonToDateTimeTransformerTest extends TestCase
{
    public function testValidTransformations()
    {
        $transformer = new CarbonToDateTimeTransformer();
        $dateTime = Factory::create()->dateTime;
        $carbon = $transformer->reverseTransform($dateTime);
        self::assertNotNull($carbon);
        self::assertSame($dateTime->getTimestamp(), $carbon->getTimestamp());

        $dateTimeAgain = $transformer->transform($carbon);
        self::assertNotNull($dateTimeAgain);
        self::assertSame($dateTime->getTimestamp(), $dateTimeAgain->getTimestamp());

        self::assertNull($transformer->transform(null));
        self::assertNull($transformer->reverseTransform(null));
    }
}
