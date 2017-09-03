<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Form\Type;

use IntlDateFormatter;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\Form\Extension\Core\DataTransformer\ArrayToPartsTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DataTransformerChain;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToLocalizedStringTransformer;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToRfc3339Transformer;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Xgc\CarbonBundle\Form\DataTransformer\CarbonToArrayTransformer;
use Xgc\CarbonBundle\Form\DataTransformer\CarbonToDateTimeTransformer;

/**
 * Class CarbonType
 *
 * @package Xgc\CarbonBundle\Form\Type
 */
class CarbonType extends DateTimeType
{

    private static $acceptedFormats = [
        IntlDateFormatter::FULL,
        IntlDateFormatter::LONG,
        IntlDateFormatter::MEDIUM,
        IntlDateFormatter::SHORT,
    ];

    private static $dateOptions = [
        'years', 'months', 'days',
        'placeholder',
        'choice_translation_domain',
        'required',
        'translation_domain',
        'html5',
        'invalid_message',
        'invalid_message_parameters',
    ];

    private static $timeOptions = [
        'hours', 'minutes', 'seconds',
        'with_minutes', 'with_seconds',
        'placeholder',
        'choice_translation_domain',
        'required',
        'translation_domain',
        'html5',
        'invalid_message',
        'invalid_message_parameters',
    ];

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @throws InvalidArgumentException
     * @throws InvalidOptionsException
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $parts     = ['year', 'month', 'day', 'hour'];
        $dateParts = ['year', 'month', 'day'];
        $timeParts = ['hour'];

        if ($options['with_minutes']) {
            $parts[]     = 'minute';
            $timeParts[] = 'minute';
        }

        if ($options['with_seconds']) {
            $parts[]     = 'second';
            $timeParts[] = 'second';
        }

        $dateFormat = is_int($options['date_format']) ? $options['date_format'] : self::DEFAULT_DATE_FORMAT;
        $timeFormat = self::DEFAULT_TIME_FORMAT;
        $calendar   = IntlDateFormatter::GREGORIAN;
        $pattern    = is_string($options['format']) ? $options['format'] : null;

        $this->checkDateFormat($dateFormat);

        if ('single_text' === $options['widget']) {
            if (self::HTML5_FORMAT === $pattern) {
                $builder->addViewTransformer(new DateTimeToRfc3339Transformer(
                    $options['model_timezone'],
                    $options['view_timezone']
                ));
            } else {
                $builder->addViewTransformer(new DateTimeToLocalizedStringTransformer(
                    $options['model_timezone'],
                    $options['view_timezone'],
                    $dateFormat,
                    $timeFormat,
                    $calendar,
                    $pattern
                ));
            }
        } else {
            $dateOptions = array_intersect_key($options, array_flip(self::$dateOptions));
            $timeOptions = array_intersect_key($options, array_flip(self::$timeOptions));

            $dateOptions['widget']         = $options['date_widget'] ?? null;
            $timeOptions['widget']         = $options['time_widget'] ?? null;
            $dateOptions['format']         = $options['date_format'] ?? null;
            $dateOptions['input']          = $timeOptions['input'] = 'array';
            $dateOptions['error_bubbling'] = $timeOptions['error_bubbling'] = true;

            $builder
                ->addViewTransformer(new DataTransformerChain([
                    new CarbonToArrayTransformer($options['model_timezone'], $options['view_timezone'], $parts),
                    new ArrayToPartsTransformer([
                        'date' => $dateParts,
                        'time' => $timeParts,
                    ]),
                ]))
                ->add('date', DateType::class, $dateOptions)
                ->add('time', TimeType::class, $timeOptions);
        }

        $this->addModelTransformer($builder, $options, $parts);
    }

    /**
     * @param int $format
     *
     * @throws InvalidOptionsException
     */
    private function checkDateFormat(int $format)
    {
        if (!in_array($format, self::$acceptedFormats, true)) {
            throw new InvalidOptionsException(
                'The "date_format" option must be one of the IntlDateFormatter constants (FULL, LONG, MEDIUM, SHORT)
                 or a string representing a custom format.'
            );
        }
    }

    /**
     * @param array $options
     * @param array $parts
     *
     * @throws \Symfony\Component\Form\Exception\UnexpectedTypeException
     */
    private function addModelTransformer(FormBuilderInterface $builder, array $options, array $parts)
    {
        if ('array' === $options['input']) {
            $builder->addModelTransformer(new ReversedTransformer(
                new CarbonToArrayTransformer($options['model_timezone'], $options['model_timezone'], $parts)
            ));
        } else {
            $builder->addModelTransformer(new CarbonToDateTimeTransformer());
        }
    }
}
