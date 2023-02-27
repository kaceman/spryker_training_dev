<?php

namespace Pyz\Yves\HelloWorld\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class IndexController extends AbstractController
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function helloAction(Request $request): JsonResponse
    {
        return $this->jsonResponse(["message" => "Hello World"]);
    }
}
