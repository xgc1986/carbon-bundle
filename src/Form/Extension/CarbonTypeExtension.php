<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Xgc\CarbonBundle\Form\DataTransformer\CarbonToDateTimeTransformer;

/**
 * Class CarbonTypeExtension
 * @package Xgc\CarbonBundle\Form\Extension
 */
class CarbonTypeExtension extends AbstractTypeExtension
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new CarbonToDateTimeTransformer());
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return DateTimeType::class;
    }
}
