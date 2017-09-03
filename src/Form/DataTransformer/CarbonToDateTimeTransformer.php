<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Form\DataTransformer;

use Carbon\Carbon;
use DateTime;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class CarbonToDateTimeTransformer
 * @package Xgc\XgcCarbonBundle\Form\DataTransformer
 */
class CarbonToDateTimeTransformer implements DataTransformerInterface
{

    /**
     * Carbon actually inherits DateTime, no conversion needed
     *
     * @param null|Carbon $value
     *
     * @return null|DateTime
     */
    public function transform($value): ?DateTime
    {
        return $value;
    }

    /**
     * @param null|DateTime $value
     *
     * @return null|Carbon
     */
    public function reverseTransform($value): ?Carbon
    {
        return $value ? Carbon::instance($value) : null;
    }
}
