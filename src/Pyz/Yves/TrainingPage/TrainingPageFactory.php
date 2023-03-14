<?php

namespace Pyz\Yves\TrainingPage;

use Pyz\Client\Antelope\AntelopeClientInterface;
use Pyz\Client\Training\TrainingClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

/**
 * @method TrainingPageConfig getConfig()
 */
class TrainingPageFactory extends AbstractFactory
{
    public function getTrainingClient(): TrainingClientInterface
    {
        return $this->getProvidedDependency(TrainingPageDependencyProvider::CLIENT_TRAINING);
    }
    public function getAntelopeClient(): AntelopeClientInterface
    {
        return $this->getProvidedDependency(TrainingPageDependencyProvider::CLIENT_ANTELOPE);
    }

    public function getColor()
    {
        return $this->getConfig()->getColor();
    }
}
