<?php
declare(strict_types=1);

namespace Tests\Unit\EventListener;

use Carbon\Carbon;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractContainerBuilderTestCase;
use Symfony\Component\HttpKernel\KernelEvents;
use Xgc\CarbonBundle\EventListener\RequestListener;

/**
 * Class RequestListenerTest
 * @package Tests\Unit\EventListener
 */
class RequestListenerTest extends AbstractContainerBuilderTestCase
{

    public function testLocale()
    {
        $this->container->setParameter('locale', 'en');
        $this->container->setParameter('encoding', 'utf8');
        $this->container->setParameter('kernel.root_dir', __DIR__ . '/../../../app/');
        $event = new RequestListener($this->container);
        $event->onKernelRequest();

        $carbon = new Carbon('2017-09-05');

        self::assertSame('Tuesday', $carbon->formatLocalized('%A'));
        self::assertSame([
            KernelEvents::CONTROLLER => [['onKernelRequest', 17]]
        ], RequestListener::getSubscribedEvents());
    }
}
