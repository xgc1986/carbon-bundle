<?php
declare(strict_types=1);

namespace Tests\Mock;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class MockParamConverter
 * @package Tests\Mock
 */
class MockParamConverter extends ParamConverter
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'mock';
    }
}
