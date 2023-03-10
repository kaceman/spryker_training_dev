<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AntelopeGuiCommunicationFactory getFactory()
 */
class EditController extends AbstractController
{
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';
    const REQUEST_PARAM_ID_ANTELOPE = 'id-antelope';
    protected const MESSAGE_ANTELOPE_UPDATED_SUCCESS = 'Antelope was successfully updated.';

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

        $antelopeCreateForm = $this->getFactory()
            ->createAntelopeCreateForm($antelopeTransfer)
            ->handleRequest($request);

        if ($antelopeCreateForm->isSubmitted() && $antelopeCreateForm->isValid()) {
            return $this->editAntelope($antelopeCreateForm);
        }

        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeCreateForm->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
    }

    /**
     * @param FormInterface $antelopeCreateForm
     * @return RedirectResponse
     * @throws ContainerKeyNotFoundException
     */
    protected function editAntelope(FormInterface $antelopeCreateForm): RedirectResponse
    {
        /** @var AntelopeTransfer|null $antelopeTransfer */
        $antelopeTransfer = $antelopeCreateForm->getData();

        $this->getFactory()
            ->getAntelopeFacade()
            ->updateAntelope($antelopeTransfer);

        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_UPDATED_SUCCESS);

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
