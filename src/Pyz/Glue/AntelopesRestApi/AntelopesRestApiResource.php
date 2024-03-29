<?php

namespace Pyz\Glue\AntelopesRestApi;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

/**
 * @method \Pyz\Glue\AntelopesRestApi\AntelopesRestApiFactory getFactory()
 */
class AntelopesRestApiResource implements AntelopesRestApiResourceInterface
{

    public function findAntelopeByName(string $name, RestRequestInterface $restRequest): ?RestResourceInterface
    {
        return $this->getFactory()
            ->createAntelopesReader()
            ->findAntelopeByName($name, $restRequest);
    }
}
