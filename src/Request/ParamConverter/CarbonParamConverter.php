<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Request\ParamConverter;

use Carbon\Carbon;
use Exception;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CarbonParamConverter
 * @package Xgc\CarbonBundle\Request
 */
class CarbonParamConverter implements ParamConverterInterface
{

    /**
     * Stores the object in the request.
     *
     * @param Request        $request The request
     * @param ParamConverter $configuration Contains the name, class and options of the object
     *
     * @return bool True if the object has been successfully set, else false
     *
     * @throws NotFoundHttpException
     * @throws InvalidArgumentException
     */
    public function apply(Request $request, ParamConverter $configuration): bool
    {
        $param = $configuration->getName();

        if (!$request->attributes->has($param)) {
            return false;
        }

        $options = $configuration->getOptions();
        $value   = $request->attributes->get($param);

        if (!$value && $configuration->isOptional()) {
            return false;
        }

        $format = $options['format'] ?? false;

        if (!$format && \filter_var($value, \FILTER_VALIDATE_INT) !== false) {
            $format = 'U';
        }

        try {
            if ($format) {
                $carbon = Carbon::createFromFormat($format, $value);
            } else {
                $carbon = new Carbon($value);
            }
        } catch (Exception $e) {
            throw new NotFoundHttpException(\sprintf('Invalid date given for parameter "%s".', $param));
        }

        $request->attributes->set($param, $carbon);

        return true;
    }

    /**
     * Checks if the object is supported.
     *
     * @param ParamConverter $configuration Should be an instance of ParamConverter
     *
     * @return bool True if the object is supported, else false
     */
    public function supports(ParamConverter $configuration): bool
    {
        if (null === $configuration->getClass()) {
            return false;
        }

        return Carbon::class === $configuration->getClass();
    }
}
