<?php

namespace Pyz\Shared\Twig;

use Spryker\Shared\Twig\TwigConfig as SprykerTwigConfig;

class TwigConfig extends SprykerTwigConfig
{
    public function getYvesThemeName(): string
    {
        return 'dunkirk';
    }

}
