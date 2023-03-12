<?php

namespace Pyz\Zed\AntelopeSearch\Communication\Plugin\Publisher;

use Pyz\Zed\AntelopeSearch\AntelopeSearchConfig;
use Pyz\Zed\AntelopeSearch\Business\AntelopeSearchFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\PublisherExtension\Dependency\Plugin\PublisherPluginInterface;

/**
 * @method AntelopeSearchFacadeInterface getFacade()
 */
class AntelopeWritePublisherPlugin extends AbstractPlugin implements PublisherPluginInterface
{

    /**
     * {@inheritDoc}
     *
     * @api
     * @param array $eventEntityTransfers
     * @param $eventName
     * @return void
     */
    public function handleBulk(array $eventEntityTransfers, $eventName): void
    {
        $this->getFacade()
            ->writeCollectionByAntelopeEvents($eventEntityTransfers);
    }

    /**
     * @api
     *
     * @return array|string[]
     */
    public function getSubscribedEvents(): array
    {
        return [
            AntelopeSearchConfig::ANTELOPE_PUBLISH,
            AntelopeSearchConfig::ENTITY_PYZ_ANTELOPE_CREATE,
            AntelopeSearchConfig::ENTITY_PYZ_ANTELOPE_UPDATE,
        ];
    }
}
