<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

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
class CreateController extends AbstractController
{
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';
    protected const MESSAGE_ANTELOPE_CREATED_SUCCESS = 'Antelope was successfully created.';
    protected const MESSAGE_ANTELOPE_CREATED_ERROR = 'Antelope already exists with name: ';


    /**
     * @param Request $request
     * @return array|RedirectResponse
     * @throws ContainerKeyNotFoundException
     */
    public function indexAction(Request $request): array|RedirectResponse
    {
        $antelopeCreateForm = $this->getFactory()
            ->createAntelopeCreateForm(new AntelopeTransfer())
            ->handleRequest($request);

        if ($antelopeCreateForm->isSubmitted() && $antelopeCreateForm->isValid()) {
            return $this->createAntelope($antelopeCreateForm);
        }

        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeCreateForm->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
    }

    /**
     * @param FormInterface $antelopeCreateForm
     * @return RedirectResponse
     */
    protected function createAntelope(FormInterface $antelopeCreateForm): RedirectResponse
    {
        /** @var AntelopeTransfer|null $antelopeTransfer */
        $antelopeTransfer = $antelopeCreateForm->getData();

        try {
            $this->getFactory()
                ->getAntelopeFacade()
                ->createAntelope($antelopeTransfer);
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $this->addErrorMessage(static::MESSAGE_ANTELOPE_CREATED_ERROR . ' ' . $antelopeTransfer->getName());
                return $this->redirectResponse($this->getAntelopeOverviewUrl());
            }
        }

        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_CREATED_SUCCESS);

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
