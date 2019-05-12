<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

$routes = new RouteCollection();

$route = new Route('{any}');
$routes->add(
    'application',
    $route->addDefaults([
        'controller' => \App\Controllers\ApplicationController::class,
        'method' => 'index'
    ])->setMethods([
        'GET'
    ])->addRequirements([
        'any' => '^(?!api.*$).*$',
    ])
);

return $routes;