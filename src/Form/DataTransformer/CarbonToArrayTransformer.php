<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Form\DataTransformer;

use Carbon\Carbon;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToArrayTransformer;

/**
 * Class CarbonToArrayTransformer
 *
 * @package Xgc\CarbonBundle\Form\DataTransformer
 */
class CarbonToArrayTransformer extends DateTimeToArrayTransformer
{
    /**
     * Transforms a localized date into a normalized date.
     *
     * @param array $value Localized date
     *
     * @return null|Carbon Normalized date
     * @throws TransformationFailedException
     *
     * @throws TransformationFailedException If the given value is not an array,
     *                                       if the value could not be transformed
     */
    public function reverseTransform($value): ?Carbon
    {
        $dateTime = parent::reverseTransform($value);
        $carbon = null;

        if ($dateTime) {
            $carbon = Carbon::instance($dateTime);
        }

        return $carbon;
    }
}
