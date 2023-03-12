<?php

namespace Pyz\Zed\AntelopeSearch\Persistence;

use Generated\Shared\Transfer\AntelopeSearchTransfer;
use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeSearch;
use Pyz\Zed\AntelopeSearch\Persistence\Exception\AntelopeSearchNotFoundException;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method AntelopeSearchPersistenceFactory getFactory()
 */
class AntelopeSearchEntityManager extends AbstractEntityManager implements AntelopeSearchEntityManagerInterface
{

    /**
     * @method AntelopeSearchPersistenceFactory getFactory()
     */
    public function createAntelopeSearch(AntelopeSearchTransfer $antelopeSearchTransfer): AntelopeSearchTransfer
    {
        $antelopeSearchEntity = $this->getFactory()
            ->createAntelopeSearchMapper()
            ->mapAntelopeSearchTransferToAntelopeSearchEntity(
                $antelopeSearchTransfer,
                new PyzAntelopeSearch(),
            );

        $antelopeSearchEntity->save();

        return $this->getFactory()
            ->createAntelopeSearchMapper()
            ->mapAntelopeSearchEntityToAntelopeSearchTransfer($antelopeSearchEntity, $antelopeSearchTransfer);
    }

    public function updateAntelopeSearch(AntelopeSearchTransfer $antelopeSearchTransfer): AntelopeSearchTransfer
    {
        $antelopeSearchEntity = $this->getFactory()
            ->createAntelopeSearchQuery()
            ->filterByIdAntelopeSearch($antelopeSearchTransfer->getIdAntelopeSearch())
            ->findOne();

        if ($antelopeSearchEntity === null) {
            throw new AntelopeSearchNotFoundException(
                sprintf(
                    'AntelopeSearch was not found by given id %s',
                    $antelopeSearchTransfer->getIdAntelopeSearch(),
                ),
            );
        }

        $antelopeSearchEntity = $this->getFactory()
            ->createAntelopeSearchMapper()
            ->mapAntelopeSearchTransferToAntelopeSearchEntity(
                $antelopeSearchTransfer,
                $antelopeSearchEntity,
            );

        $antelopeSearchEntity->save();

        return $this->getFactory()
            ->createAntelopeSearchMapper()
            ->mapAntelopeSearchEntityToAntelopeSearchTransfer($antelopeSearchEntity, $antelopeSearchTransfer);
    }
}
