<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method AntelopeGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{

    /**
     * @return array
     * @throws ContainerKeyNotFoundException
     */
    public function indexAction(): array
    {
        $table = $this->getFactory()
            ->createAntelopeTable();

        return $this->viewResponse([
            'antelopeTable' => $table->render(),
        ]);
    }

    /**
     * @return JsonResponse
     * @throws ContainerKeyNotFoundException
     */
    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()
            ->createAntelopeTable();

        return $this->jsonResponse($table->fetchData());
    }

}
