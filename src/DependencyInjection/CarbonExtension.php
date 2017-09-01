<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\DependencyInjection;

use Exception;
use InvalidArgumentException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class CarbonExtension
 * @package Xgc\CarbonBundle\DependencyInjection
 */
class CarbonExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array            $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws InvalidArgumentException When provided tag is not defined in this extension
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));

        $loader->load('form.yml');
        $loader->load('doctrine.yml');
        $loader->load('services.yml');
    }
}
