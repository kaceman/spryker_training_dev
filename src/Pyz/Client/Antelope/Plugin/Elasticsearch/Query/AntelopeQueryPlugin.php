<?php

namespace Pyz\Client\Antelope\Plugin\Elasticsearch\Query;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Exists;
use Elastica\Query\MatchQuery;
use Generated\Shared\Transfer\SearchContextTransfer;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\SearchContextAwareQueryInterface;

class AntelopeQueryPlugin implements QueryInterface, SearchContextAwareQueryInterface
{
    private string $name;
    const SOURCE_IDENTIFIER = 'page';
    /**
     * @var SearchContextTransfer
     */
    protected $searchContextTransfer;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getSearchQuery()
    {
        $boolQuery = (new BoolQuery())
            ->addMust(
                new Exists('id_antelope')
            )
            ->addMust(
                new MatchQuery('name', $this->name)
            );
        return (new Query())->setQuery($boolQuery);
    }

    public function getSearchContext(): SearchContextTransfer
    {
        if (!$this->hasSearchContext()) {
            $this->setupDefaultSearchContext();
        }
        return $this->searchContextTransfer;
    }

    public function setSearchContext(SearchContextTransfer $searchContextTransfer): void
    {
        // TODO: Implement setSearchContext() method.
    }

    private function hasSearchContext(): bool
    {
        return (bool)$this->searchContextTransfer;
    }

    private function setupDefaultSearchContext()
    {
        $searchContextTransfer = new SearchContextTransfer();
        $searchContextTransfer->setSourceIdentifier(static::SOURCE_IDENTIFIER);
        $this->searchContextTransfer = $searchContextTransfer;
    }
}
