<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeGuiCommunicationFactory getFactory()
 */
class DeleteController extends AbstractController
{
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';
    const REQUEST_PARAM_ID_ANTELOPE = 'id-antelope';
    protected const MESSAGE_ANTELOPE_DELETED_SUCCESS = 'Antelope was successfully deleted.';

    /**
     * @param Request $request
     * @return array|RedirectResponse
     * @throws ContainerKeyNotFoundException
     */
    public function indexAction(Request $request): array|RedirectResponse
    {
        $idAntelope = $this->castId($request->get(static::REQUEST_PARAM_ID_ANTELOPE));

        $antelopeResponseTransfer = $this->getFactory()->getAntelopeFacade()
            ->getAntelope((new AntelopeCriteriaTransfer())->setIdAntelope($idAntelope));

        $antelopeTransfer = null;
        if ($antelopeResponseTransfer->getIsSuccessful()) {
            $antelopeTransfer = $antelopeResponseTransfer->getAntelope();
        }

        return $this->deleteAntelope($antelopeTransfer);
    }

    /**
     * @param AntelopeTransfer $antelopeTransfer
     * @return RedirectResponse
     * @throws ContainerKeyNotFoundException
     */
    private function deleteAntelope(AntelopeTransfer $antelopeTransfer): RedirectResponse
    {
        $this->getFactory()
            ->getAntelopeFacade()
            ->deleteAntelope($antelopeTransfer);

        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_DELETED_SUCCESS);

        return $this->redirectResponse($this->getAntelopeOverviewUrl());
    }

    /**
     * @return string
     */
    protected function getAntelopeOverviewUrl(): string
    {
        return (string)Url::generate(static::URL_ANTELOPE_OVERVIEW);
    }
}
