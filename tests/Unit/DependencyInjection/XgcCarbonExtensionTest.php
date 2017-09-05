<?php
declare(strict_types=1);

namespace Tests\Unit\DependencyInjection;

use Carbon\Carbon;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\DoctrineExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Xgc\CarbonBundle\DependencyInjection\XgcCarbonExtension;

class XgcCarbonExtensionTest extends AbstractExtensionTestCase
{

    public function testLoad()
    {
        $this->load();

        self::assertSame('en', Carbon::getLocale());
    }

    /**
     * Return an array of container extensions you need to be registered for each test (usually just the container
     * extension you are testing.
     *
     * @return ExtensionInterface[]
     */
    protected function getContainerExtensions(): array
    {
        $this->container->setParameter('locale', 'en');
        $this->container->setParameter('kernel.debug', 'true');
        $this->container->setParameter('kernel.bundles_metadata', []);
        $this->container->setParameter('kernel.root_dir', __DIR__ . '/../../../app/');

        return [
            new XgcCarbonExtension(),
            new DoctrineExtension(),
            new TwigExtension()
        ];
    }
}
