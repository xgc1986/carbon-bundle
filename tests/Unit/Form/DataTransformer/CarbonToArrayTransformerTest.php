<?php
declare(strict_types=1);

namespace Tests\Unit\Form\DataTransformer;

use Xgc\CarbonBundle\Form\DataTransformer\CarbonToArrayTransformer;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonToArrayTransformerTest
 *
 * @package Tests\Unit\Form\DataTransformer
 */
class CarbonToArrayTransformerTest extends TestCase
{

    public function testReverseTransform()
    {
        $transformer = new CarbonToArrayTransformer();
        self::assertNull($transformer->reverseTransform(null));

        self::assertNotNull($transformer->reverseTransform([
            'month'  => 2,
            'day'    => 21,
            'year'   => 1986,
            'hour'   => 12,
            'minute' => 0,
            'second' => 0
        ]));
    }
}
