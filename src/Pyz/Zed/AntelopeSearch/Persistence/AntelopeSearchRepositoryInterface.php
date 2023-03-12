<?php

namespace Pyz\Zed\AntelopeSearch\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeSearchTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeSearchRepositoryInterface
{
    /**
     * @param AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return AntelopeTransfer[]
     */
    public function getAntelopes(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): array;

    /**
     * @param AntelopeSearchCriteriaTransfer $antelopeSearchCriteriaTransfer
     *
     * @return AntelopeSearchTransfer[]
     */
    public function getAntelopeSearches(AntelopeSearchCriteriaTransfer $antelopeSearchCriteriaTransfer): array;
}
