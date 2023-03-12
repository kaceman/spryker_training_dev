<?php

namespace Pyz\Zed\AntelopeSearch\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeSearch\Persistence\PyzAntelopeSearchQuery;
use Pyz\Zed\AntelopeSearch\AntelopeSearchDependencyProvider;
use Pyz\Zed\AntelopeSearch\Persistence\Propel\AntelopeSearch\Mapper\AntelopeSearchMapper;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class AntelopeSearchPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return PyzAntelopeSearchQuery
     */
    public function createAntelopeSearchQuery(): PyzAntelopeSearchQuery
    {
        return PyzAntelopeSearchQuery::create();
    }

    /**
     * @return AntelopeSearchMapper
     */
    public function createAntelopeSearchMapper(): AntelopeSearchMapper
    {
        return new AntelopeSearchMapper();
    }

    /**
     * @return PyzAntelopeQuery
     */
    public function getAntelopePropelQuery(): PyzAntelopeQuery
    {
        return $this->getProvidedDependency(AntelopeSearchDependencyProvider::PROPEL_QUERY_ANTELOPE);
    }
}
