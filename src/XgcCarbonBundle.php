<?php
declare(strict_types=1);

namespace Xgc\CarbonBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Xgc\CarbonBundle\DependencyInjection\XgcCarbonExtension;

/**
 * Class XgcCarbonBundle
 * @package Xgc\XgcCarbonBundle
 */
class XgcCarbonBundle extends Bundle
{
    /**
     * @return mixed
     */
    public function getExtension()
    {
        $this->extension = $this->extension ?? new XgcCarbonExtension();
        return $this->extension;
    }
}
