<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle;

use LogicException;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Xgc\CarbonBundle\DependencyInjection\CarbonExtension;

/**
 * Class CarbonBundle
 * @package Xgc\CarbonBundle
 */
class CarbonBundle extends Bundle
{
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface|null The container extension
     *
     * @throws LogicException
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        $this->extension = $this->extension ?? new CarbonExtension();
        return $this->extension;
    }
}
