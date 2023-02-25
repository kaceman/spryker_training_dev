<?php

namespace Pyz\Yves\TrainingPage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;

/**
 * @method \Pyz\Yves\TrainingPage\TrainingPageFactory getFactory()
 */
class AntelopeController extends AbstractController
{
    public function getAction(string $name)
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $antelopeCriteriaTransfer->setName($name);

        $antelopeResponseTransfer = $this->getFactory()
            ->getTrainingClient()
            ->getAntelope($antelopeCriteriaTransfer);

        return $this->view(
            [
                'antelope' => $antelopeResponseTransfer->getAntelope(),
                'color' => $this->getFactory()->getColor(),
            ],
            [],
            '@TrainingPage/views/antelope/get.twig'
        );
    }
}
