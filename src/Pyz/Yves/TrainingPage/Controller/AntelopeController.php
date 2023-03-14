<?php

namespace Pyz\Yves\TrainingPage\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Pyz\Client\Antelope\AntelopeClientInterface;
use Pyz\Yves\TrainingPage\TrainingPageFactory;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Yves\Kernel\View\View;

/**
 * @method TrainingPageFactory getFactory()
 * @method AntelopeClientInterface getClient()
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

    /**
     * @param string $name
     * @return View
     */
    public function showAction(string $name): View
    {
        $antelope = $this->getFactory()->getAntelopeClient()->getAntelopeByName($name);

        return $this->view(
            [
                'antelope' => $antelope,
            ],
            [],
            '@TrainingPage/views/antelope/show.twig'
        );
    }
}
