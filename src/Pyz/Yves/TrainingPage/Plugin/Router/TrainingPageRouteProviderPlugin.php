<?php

namespace Pyz\Yves\TrainingPage\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class TrainingPageRouteProviderPlugin extends AbstractRouteProviderPlugin
{

    public const ROUTE_NAME_TRAINING_ANTELOPE_NAME = 'training/antelope/_name_';
    public const ROUTE_NAME_TRAINING_ANTELOPE_SHOW_NAME = 'training/antelope-show/_name_';

    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addTrainingAntelopeGetRoute($routeCollection);
        $routeCollection = $this->addTrainingAntelopeShowGetRoute($routeCollection);

        return $routeCollection;
    }

    private function addTrainingAntelopeGetRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('training/antelope/{name}', 'TrainingPage', 'Antelope', 'getAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_TRAINING_ANTELOPE_NAME, $route);

        return $routeCollection;
    }

    private function addTrainingAntelopeShowGetRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('training/antelope-show/{name}', 'TrainingPage', 'Antelope', 'showAction');
        $route = $route->setMethods(['GET']);
        $routeCollection->add(static::ROUTE_NAME_TRAINING_ANTELOPE_SHOW_NAME, $route);

        return $routeCollection;
    }
}
