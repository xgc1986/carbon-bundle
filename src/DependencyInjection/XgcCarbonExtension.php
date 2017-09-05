<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\DependencyInjection;

use Carbon\Carbon;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
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
        Carbon::setLocale($container->getParameter('locale'));
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'xgc_carbon';
    }
}
