<?php

namespace Pyz\Glue\AntelopesRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\Controller\AbstractController;

class AntelopesResourceController extends AbstractController
{
    /**
     * @Glue({
     *     "getResourceById": {
     *          "summary": [
     *              "Retrieves Antelopes by name."
     *          ],
     *          "parameters": [{
     *              "name": "Accept-Language",
     *              "in": "header"
     *          }],
     *          "responses": {
     *              "400": "Antelope uuid is not specified.",
     *              "404": "Antelope not found."
     *          }
     *     }
     * })
     *
     * @param RestRequestInterface $restRequest
     *
     * @return RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()
            ->createAntelopesReader()
            ->getAntelopeSearchData($restRequest);
    }
}
