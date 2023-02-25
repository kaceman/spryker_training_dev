<?php

namespace Pyz\Yves\TrainingPage;

use Spryker\Yves\Kernel\AbstractBundleConfig;

class TrainingPageConfig extends AbstractBundleConfig
{
    public const COLOR_CONFIG_KEY = 'AntelopeColor';

    public function getColor()
    {
        return $this->get(self::COLOR_CONFIG_KEY);
    }
}
