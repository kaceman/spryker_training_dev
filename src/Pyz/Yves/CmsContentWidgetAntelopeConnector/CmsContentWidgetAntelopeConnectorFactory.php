<?php

namespace Pyz\Yves\CmsContentWidgetAntelopeConnector;

use Pyz\Client\Antelope\AntelopeClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\Kernel\Exception\Container\ContainerKeyNotFoundException;

class CmsContentWidgetAntelopeConnectorFactory extends AbstractFactory
{
    /**
     * @return AntelopeClientInterface
     * @throws ContainerKeyNotFoundException
     */
    public function getAntelopeClient(): AntelopeClientInterface
    {
        return $this->getProvidedDependency(CmsContentWidgetAntelopeConnectorDependencyProvider::CLIENT_ANTELOPE);
    }
}
