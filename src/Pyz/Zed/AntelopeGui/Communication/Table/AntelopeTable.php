<?php

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{

    public const COL_ID_ANTELOPE = 'id_antelope';
    public const COL_NAME = 'name';
    public const COL_COLOR = 'color';
    const COL_ACTIONS = 'actions';
    const REQUEST_PARAM_ID_ANTELOPE = 'id-antelope';

    private PyzAntelopeQuery $antelopeQuery;

    public function __construct(PyzAntelopeQuery $antelopeQuery)
    {
        $this->antelopeQuery = $antelopeQuery;
    }


    /**
     * @param TableConfiguration $config
     * @return TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE => 'Antelope ID',
            static::COL_NAME => 'Name',
            static::COL_COLOR => 'Color',
            static::COL_ACTIONS => 'Actions',
        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE,
            static::COL_NAME,
            static::COL_COLOR,
        ]);

        $config->setSearchable([
            PyzAntelopeTableMap::COL_NAME,
            PyzAntelopeTableMap::COL_COLOR,
        ]);

        $config->setRawColumns([
            static::COL_ACTIONS,
        ]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeEntityCollection = $this->runQuery(
            $this->antelopeQuery,
            $config,
            true
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    /**
     * @param array|ObjectCollection $antelopeEntityCollection
     * @return array
     */
    private function mapReturns(array|ObjectCollection $antelopeEntityCollection): array
    {
        $returns = [];

        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $return = $antelopeEntity->toArray();
            $return[static::COL_ACTIONS] = $this->generateActionsButton($antelopeEntity);
            $returns[] = $return;
        }

        return $returns;
    }

    private function generateActionsButton(PyzAntelope $antelopeEntity): string
    {
        $buttonGroupItems = [];

        $buttonGroupItems[] = $this->generateEditAntelopeButtonGroupItem($antelopeEntity);

        $buttonGroupItems[] = $this->generateAntelopeRemoveButtonGroupItem($antelopeEntity);

        return $this->generateButtonGroup(
            $buttonGroupItems,
            'Actions',
            [
                'icon' => '',
            ],
        );
    }

    private function generateEditAntelopeButtonGroupItem(PyzAntelope $antelopeEntity): array
    {
        return $this->createButtonGroupItem(
            'Edit',
            Url::generate('/antelope-gui/edit', [
                static::REQUEST_PARAM_ID_ANTELOPE => $antelopeEntity->getIdAntelope(),
            ]),
        );
    }

    private function generateAntelopeRemoveButtonGroupItem(PyzAntelope $antelopeEntity): array
    {
        return $this->createButtonGroupItem(
            'Delete',
            Url::generate('/antelope-gui/delete', [
                static::REQUEST_PARAM_ID_ANTELOPE => $antelopeEntity->getIdAntelope(),
            ]),
        );
    }
}
