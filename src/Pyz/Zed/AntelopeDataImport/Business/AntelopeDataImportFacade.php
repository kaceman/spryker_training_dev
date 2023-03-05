<?php

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\AntelopeDataImport\Business;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method AntelopeDataImportBusinessFactory getFactory()
 */
class AntelopeDataImportFacade extends AbstractFacade implements Business\AntelopeDataImportFacadeInterface
{

    /**
     * @inheritDoc
     */
    public function importAntelope(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()
            ->createAntelopeDataImport($dataImporterConfigurationTransfer)
            ->import($dataImporterConfigurationTransfer);
    }
}
