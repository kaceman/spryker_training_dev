<?php

namespace Pyz\Zed\Training\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeResponseTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface TrainingFacadeInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer;

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): void;

    public function getAntelope(AntelopeCriteriaTransfer $antelopeCriteria): AntelopeResponseTransfer;
}
