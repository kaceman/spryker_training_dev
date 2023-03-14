<?php

namespace Pyz\Client\Antelope\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Spryker\Client\Search\Plugin\Elasticsearch\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class AntelopeResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{

    public const NAME = 'antelope';

    /**
     * @param ResultSet $searchResult
     * @param array $requestParameters
     * @return array
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        foreach ($searchResult->getResults() as $document) {
            return $document->getSource();
        }

        return [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
