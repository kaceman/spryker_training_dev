<?php

namespace Pyz\Yves\TrainingPage;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;

class TrainingPageDependencyProvider extends AbstractBundleDependencyProvider
{
    public const CLIENT_TRAINING = 'CLIENT_TRAINING';
    public const CLIENT_ANTELOPE = 'CLIENT_ANTELOPE';

    public function provideDependencies(Container $container) : Container
    {
        $container = $this->addTrainingClient($container);
        $container = $this->addAntelopeClient($container);

        return $container;
    }

    protected function addTrainingClient(Container $container) : Container
    {
        $container->set(static::CLIENT_TRAINING, function (Container $container) {
            return $container->getLocator()->training()->client();
        });

        return $container;
    }

    private function addAntelopeClient(Container $container) : Container
    {
        $container->set(static::CLIENT_ANTELOPE, function (Container $container) {
            return $container->getLocator()->antelope()->client();
        });

        return $container;
    }
}
