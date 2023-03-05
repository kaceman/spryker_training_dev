<?php

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

interface AntelopeDataImportFacadeInterface
{
    /**
     * Specification:
     *  - Imports antelopes
     *
     * @api
     *
     * @param DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     * @return DataImporterReportTransfer
     */
    public function importAntelope(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer;
}
