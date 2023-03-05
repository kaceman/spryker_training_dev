<?php

namespace Pyz\Zed\AntelopeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeDataImport\Business\DataImportStep\AntelopeWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class AntelopeDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @param DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return DataImporterInterface
     */
    public function createAntelopeDataImport(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterInterface
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createAntelopeWriterStep());

        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }


    /**
     * @return AntelopeWriterStep
     */
    public function createAntelopeWriterStep(): AntelopeWriterStep
    {
        return new AntelopeWriterStep();
    }

}
