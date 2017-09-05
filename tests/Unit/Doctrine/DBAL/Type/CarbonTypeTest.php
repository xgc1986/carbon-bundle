<?php
declare(strict_types=1);

namespace Tests\Unit\Doctrine\DBAL\Type;

use Carbon\Carbon;
use Doctrine\DBAL\Types\Type;
use Faker\Factory;
use Tests\Mock\MockPlatform;
use Xgc\CarbonBundle\Doctrine\DBAL\Type\CarbonType;
use Xgc\CarbonBundle\Test\TestCase;

/**
 * Class PhpConstantsTest
 * @package Tests\Unit
 */
class CarbonTypeTest extends TestCase
{
    /**
     * @var MockPlatform
     */
    protected $platform;

    /**
     * @var Type
     */
    protected $type;

    protected function setUp(): void
    {
        if (!Type::hasType('carbon')) {
            Type::addType('carbon', CarbonType::class);
        }

        $this->platform = new MockPlatform();
        $this->type     = Type::getType('carbon');
    }

    /**
     * @return string
     */
    protected function getStringDateTime(): string
    {
        return Factory::create()->dateTime->format($this->platform->getDateTimeFormatString());
    }

    public function testConvertToPHPValue()
    {
        self::assertInstanceOf(Carbon::class, $this->type->convertToPHPValue('1986-02-21 00:00:00', $this->platform));
    }

    public function testNullConversion()
    {
        self::assertNull($this->type->convertToPHPValue(null, $this->platform));
        self::assertNull($this->type->convertToDatabaseValue(null, $this->platform));
    }

    /**
     * @expectedException \Doctrine\DBAL\Types\ConversionException
     */
    public function testConversionToPHPException()
    {
        $this->type->convertToPHPValue('', $this->platform);
    }

    public function testConvertToDatabaseValue()
    {
        $expected = $this->getStringDateTime();
        $value    = Carbon::createFromFormat($this->platform->getDateTimeFormatString(), $expected);

        self::assertSame($expected, $this->type->convertToDatabaseValue($value, $this->platform));
    }

    /**
     * @expectedException \Doctrine\DBAL\Types\ConversionException
     */
    public function testConversionToDatabaseException()
    {
        $this->type->convertToDatabaseValue(Factory::create()->dateTime, $this->platform);
    }

    /**
     * @expectedException \Doctrine\DBAL\DBALException
     */
    public function testGetSQLDeclaration()
    {
        $this->type->getSQLDeclaration([], $this->platform);
    }
}
