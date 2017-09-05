<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\DependencyInjection;

use Carbon\Carbon;
use Exception;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class XgcCarbonExtension
 * @package Xgc\CarbonBundle\DependencyInjection
 */
class XgcCarbonExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        if (!$container->hasParameter('encoding')) {
            $container->setParameter('encoding', 'utf8');
        }
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'xgc_carbon';
    }
}
