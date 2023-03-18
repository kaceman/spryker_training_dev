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
    // this could be name or id
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
            );
        if (is_numeric($this->name)) {
            $boolQuery = $boolQuery->addShould(
                new MatchQuery('name', $this->name)
            );
            $boolQuery = $boolQuery->addShould(
                new MatchQuery('id_antelope', $this->name)
            );
        } else {
            $boolQuery = $boolQuery->addMust(
                new MatchQuery('name', $this->name)
            );
        }
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
        $this->searchContextTransfer = $searchContextTransfer;
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
