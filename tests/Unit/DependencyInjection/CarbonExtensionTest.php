<?php
declare(strict_types=1);

namespace Tests\Unit\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Xgc\CarbonBundle\DependencyInjection\CarbonExtension;
use Xgc\CarbonBundle\Type\CarbonType;

/**
 * Class CarbonExtensionTest
 * @package Tests\Unit\DependencyInjection
 */
class CarbonExtensionTest extends AbstractExtensionTestCase
{

    public function testLoadConfig()
    {
        $this->load();

        self::assertEquals(
            [
                'dbal' => [
                    'mapping_types' => [
                        'carbon' => 'datetime'
                    ],
                    'types'         => [
                        'carbon' => CarbonType::class
                    ]
                ]
            ],
            $this->container->getExtensionConfig('doctrine')[0]
        );
    }

    /**
     * Return an array of container extensions you need to be registered for each test (usually just the container
     * extension you are testing.
     *
     * @return ExtensionInterface[]
     */
    protected function getContainerExtensions(): array
    {
        $this->container->setParameter('kernel.debug', true);

        return [
            new CarbonExtension(),
            new DoctrineExtension()
        ];
    }
}
