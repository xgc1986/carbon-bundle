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

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @throws InvalidArgumentException
     * @throws \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
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

        if (!in_array($dateFormat, self::$acceptedFormats, true)) {
            throw new InvalidOptionsException(
                'The "date_format" option must be one of the IntlDateFormatter constants (FULL, LONG, MEDIUM, SHORT)
                 or a string representing a custom format.'
            );
        }

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
            // Only pass a subset of the options to children
            $dateOptions = array_intersect_key($options, array_flip([
                'years',
                'months',
                'days',
                'placeholder',
                'choice_translation_domain',
                'required',
                'translation_domain',
                'html5',
                'invalid_message',
                'invalid_message_parameters',
            ]));

            $timeOptions = array_intersect_key($options, array_flip([
                'hours',
                'minutes',
                'seconds',
                'with_minutes',
                'with_seconds',
                'placeholder',
                'choice_translation_domain',
                'required',
                'translation_domain',
                'html5',
                'invalid_message',
                'invalid_message_parameters',
            ]));

            if (null !== $options['date_widget']) {
                $dateOptions['widget'] = $options['date_widget'];
            }

            if (null !== $options['time_widget']) {
                $timeOptions['widget'] = $options['time_widget'];
            }

            if (null !== $options['date_format']) {
                $dateOptions['format'] = $options['date_format'];
            }

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

        if ('string' === $options['input'] || 'timestamp' === $options['input']) {
            $builder->addModelTransformer(new CarbonToDateTimeTransformer());
        } elseif ('array' === $options['input']) {
            $builder->addModelTransformer(new ReversedTransformer(
                new CarbonToArrayTransformer($options['model_timezone'], $options['model_timezone'], $parts)
            ));
        }
    }
}
