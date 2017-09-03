<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Doctrine\DBAL\Type;

use Carbon\Carbon;
use DateTime;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use InvalidArgumentException;

/**
 * Class CarbonType
 * @package Xgc\CarbonBundle\Type
 */
class CarbonType extends Type
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return Type::DATETIME;
    }

    /**
     * @param array            $fieldDeclaration
     * @param AbstractPlatform $platform
     *
     * @return string
     *
     * @throws DBALException
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
    {
        return $platform->getDateTimeTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param null|Carbon|mixed $value
     * @param AbstractPlatform  $platform
     *
     * @return mixed|string
     *
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return $value;
        }

        if ($value instanceof Carbon) {
            return $value->format($platform->getDateTimeFormatString());
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'Carbon']);
    }

    /**
     * @param mixed|string     $value
     * @param AbstractPlatform $platform
     *
     * @return bool|DateTime|false|mixed
     *
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value instanceof Carbon) {
            return $value;
        }

        try {
            $carbon = Carbon::createFromFormat($platform->getDateTimeFormatString(), $value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailedFormat(
                $value,
                $this->getName(),
                $platform->getDateTimeFormatString()
            );
        }

        return $carbon;
    }
}
