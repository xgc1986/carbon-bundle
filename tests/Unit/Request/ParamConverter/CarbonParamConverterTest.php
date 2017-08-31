<?php
declare(strict_types=1);

namespace Tests\Unit\Request\ParamConverter;

use Carbon\Carbon;
use DateTime;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Request;
use Tests\Mock\MockParamConverter;
use Xgc\CarbonBundle\Request\ParamConverter\CarbonParamConverter;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class CarbonParamConverterTest
 * @package Tests\Unit\Request\ParamConverter
 */
class CarbonParamConverterTest extends TestCase
{

    /**
     * @return array
     */
    public function formatsProvider(): array
    {
        $dateTime = Factory::create()->dateTime;

        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        return [
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::ATOM)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::COOKIE)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC822)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC850)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC1036)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC1123)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC2822)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC3339)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC3339_EXTENDED)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RFC7231)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::RSS)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format(DateTime::W3C)],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format('Y-m-d H:i:s')],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format('d-m-Y H:i:s')],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format('d-m-Y')],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format('Y-m-d')],
            [$request, $paramConverter, $carbonParamConventer, $dateTime->format('U')]
        ];
    }

    public function testSupportsSuccess()
    {
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        self::assertTrue($carbonParamConventer->supports($paramConverter));
    }

    public function testSupportsFails()
    {
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $paramConverter->setClass(Factory::create()->word);
        self::assertFalse($carbonParamConventer->supports($paramConverter));

        $paramConverter->setClass(null);
        self::assertFalse($carbonParamConventer->supports($paramConverter));
    }

    /**
     * @dataProvider formatsProvider
     *
     * @param Request              $request
     * @param MockParamConverter   $paramConverter
     * @param CarbonParamConverter $carbonParamConventer
     * @param string               $formattedDateTime
     */
    public function testApplySuccess(
        Request $request,
        MockParamConverter $paramConverter,
        CarbonParamConverter $carbonParamConventer,
        string $formattedDateTime
    ) {
        $request->attributes->add([$paramConverter->getName() => $formattedDateTime]);

        self::assertTrue($carbonParamConventer->apply($request, $paramConverter));
    }

    public function testApplySuccessWithFormat()
    {
        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $paramConverter->setOptions(['format' => 'm']);
        $request->attributes->add([$paramConverter->getName() => '11']);

        self::assertTrue($carbonParamConventer->apply($request, $paramConverter));
    }

    public function testApplyFailsWithoutParams()
    {
        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $paramConverter->setOptions(['format' => 'm']);

        self::assertFalse($carbonParamConventer->apply($request, $paramConverter));
    }

    public function testApplyFailsWithOptional()
    {
        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $paramConverter->setOptions(['format' => 'm']);
        $paramConverter->setIsOptional(true);
        $request->attributes->add([$paramConverter->getName() => null]);

        self::assertFalse($carbonParamConventer->apply($request, $paramConverter));
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testApplyFailsWithBadFormat()
    {
        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $paramConverter->setOptions(['format' => 'Y-m-d']);
        $request->attributes->add([$paramConverter->getName() => '*']);

        self::assertFalse($carbonParamConventer->apply($request, $paramConverter));
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testApplyFailsWithBadData()
    {
        $request              = new Request();
        $paramConverter       = new MockParamConverter([]);
        $carbonParamConventer = new CarbonParamConverter();
        $paramConverter->setClass(Carbon::class);

        $request->attributes->add([$paramConverter->getName() => '-o']);

        self::assertFalse($carbonParamConventer->apply($request, $paramConverter));
    }
}
