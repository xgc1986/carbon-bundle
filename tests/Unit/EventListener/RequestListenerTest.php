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
        $this->container->setParameter('locale', 'es');
        $this->container->setParameter('kernel.root_dir', __DIR__ . '/../../../app/');
        $event = new RequestListener($this->container);
        $event->onKernelRequest();

        self::assertSame('es', Carbon::getLocale());
        self::assertSame([
            KernelEvents::CONTROLLER => [['onKernelRequest', 17]]
        ], RequestListener::getSubscribedEvents());
    }
}
