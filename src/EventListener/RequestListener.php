<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle\EventListener;

use Carbon\Carbon;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RequestListener
 * @package Xgc\CarbonBundle\EventListener
 */
class RequestListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * RequestListener constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelRequest()
    {
        $locale = $this->container->getParameter('locale');
        $encoding = $this->container->getParameter('encoding');

        \setlocale(\LC_TIME, "$locale.$encoding");
        Carbon::setLocale("$locale.$encoding");
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => [['onKernelRequest', 17]]
        ];
    }
}
