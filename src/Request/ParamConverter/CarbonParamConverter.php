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
 * @package Xgc\XgcCarbonBundle\Request
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
        if (!$this->isValidInput($request, $configuration)) {
            return false;
        }

        $param   = $configuration->getName();
        $options = $configuration->getOptions();
        $value   = $request->attributes->get($param);
        $format  = $this->loadFormat($options, $value);
        $carbon  = $this->getCarbon($format, $value, $param);

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

    /**
     * @param Request        $request
     * @param ParamConverter $configuration
     *
     * @return bool
     */
    private function isValidInput(Request $request, ParamConverter $configuration): bool
    {
        $param = $configuration->getName();

        return !(
            (!$request->attributes->has($param)) ||
            (!$request->attributes->get($param) && $configuration->isOptional())
        );
    }

    /**
     * @param array  $options
     *
     * @param string $value
     *
     * @return null|string ;
     */
    private function loadFormat(array $options, string $value): ?string
    {
        $format = $options['format'] ?? null;

        if (!$format && \filter_var($value, \FILTER_VALIDATE_INT) !== false) {
            $format = 'U';
        }

        return $format;
    }

    /**
     * @param null|string $format
     * @param string      $value
     * @param string      $param
     *
     * @return Carbon
     *
     * @throws NotFoundHttpException
     */
    private function getCarbon(?string $format, string $value, string $param): Carbon
    {
        try {
            if ($format !== null) {
                return Carbon::createFromFormat($format, $value);
            }

            return new Carbon($value);
        } catch (Exception $e) {
            throw new NotFoundHttpException(\sprintf('Invalid date given for parameter "%s".', $param));
        }
    }
}
