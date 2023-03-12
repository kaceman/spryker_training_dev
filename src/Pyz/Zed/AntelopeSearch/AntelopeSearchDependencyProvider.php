<?php

namespace Pyz\Zed\AntelopeSearch;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class AntelopeSearchDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_EVENT_BEHAVIOR = 'FACADE_EVENT_BEHAVIOR';

    public const PROPEL_QUERY_ANTELOPE = 'PROPEL_QUERY_ANTELOPE';

    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        return $this->addEventBehaviorFacade($container);
    }

    protected function addEventBehaviorFacade(Container $container): Container
    {
        $container->set(static::FACADE_EVENT_BEHAVIOR, function (Container $container) {
            return $container->getLocator()->eventBehavior()->facade();
        });

        return $container;
    }

    public function providePersistenceLayerDependencies(Container $container)
    {
        $container = parent::providePersistenceLayerDependencies($container);

        return $this->addAntelopePropelQuery($container);
    }

    private function addAntelopePropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_ANTELOPE, $container->factory(function () {
            return PyzAntelopeQuery::create();
        }));

        return $container;
    }


}
