<?php

namespace Pyz\Zed\Training\Persistence;

use Exception;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Exception\PropelException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

class TrainingEntityManager extends AbstractEntityManager implements TrainingEntityManagerInterface
{

    /**
     * @throws Exception
     */
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        try {
            $antelopeEntity->save();
        } catch (PropelException $e) {
            if ($e->getPrevious()->getCode() == '23000') {
                throw new Exception($e->getPrevious()->errorInfo[2] ?? '', 23000);
            }
        }

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function updateAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = PyzAntelopeQuery::create()->findOneByIdAntelope($antelopeTransfer->getIdAntelope());
        $antelopeEntity->setName($antelopeTransfer->getName());
        $antelopeEntity->setColor($antelopeTransfer->getColor());
        $antelopeEntity->save();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): void
    {
        $antelopeEntity = PyzAntelopeQuery::create()->findOneByIdAntelope($antelopeTransfer->getIdAntelope());
        $antelopeEntity->delete();
    }
}
