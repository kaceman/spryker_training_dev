<?php

namespace Pyz\Client\Antelope;

use Pyz\Client\Antelope\Plugin\Elasticsearch\ResultFormatter\AntelopeResultFormatterPlugin;
use Spryker\Client\Kernel\AbstractDependencyProvider;
use Spryker\Client\Kernel\Container;

class AntelopeDependencyProvider extends AbstractDependencyProvider
{
    public const CLIENT_SEARCH = 'CLIENT_SEARCH';
    public const ANTELOPE_RESULT_FORMATTER_PLUGINS = 'ANTELOPE_RESULT_FORMATTER_PLUGINS';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideServiceLayerDependencies(Container $container): Container
    {
        $container = $this->addSearchClient($container);
        return $this->addCatalogSearchResultFormatterPlugins($container);
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    private function addSearchClient(Container $container): Container
    {
        $container[static::CLIENT_SEARCH] = function (Container $container) {
            return $container->getLocator()->search()->client();
        };

        return $container;
    }

    /**
     * @param Container $container
     *
     * @return Container
     */
    private function addCatalogSearchResultFormatterPlugins(Container $container): Container
    {
        $container[static::ANTELOPE_RESULT_FORMATTER_PLUGINS] = function () {
            return [
                new AntelopeResultFormatterPlugin(),
            ];
        };

        return $container;
    }
}
