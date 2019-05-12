<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

$routes = new RouteCollection();
$routes->addPrefix('api');

$route = new Route('/api/contacts');
$routes->add(
    'contacts.index',
    $route->addDefaults([
        'controller' => \App\Controllers\ContactController::class,
        'method' => 'index'
    ])->setMethods(['GET'])
);

$route = new Route('/api/contacts/{id}');
$routes->add(
    'contacts.show',
    $route->addDefaults([
        'controller' => \App\Controllers\ContactController::class,
        'method' => 'show'
    ])->setMethods(['GET'])
);

$route = new Route('/api/contacts');
$routes->add(
    'contacts.store',
    $route->addDefaults([
        'controller' => \App\Controllers\ContactController::class,
        'method' => 'store'
    ])->setMethods(['POST'])
);

$route = new Route('/api/contacts/{id}');
$routes->add(
    'contacts.update',
    $route->addDefaults([
        'controller' => \App\Controllers\ContactController::class,
        'method' => 'update'
    ])->setMethods(['PUT'])
);

$route = new Route('/api/contacts/{id}');
$routes->add(
    'contacts.destroy',
    $route->addDefaults([
        'controller' => \App\Controllers\ContactController::class,
        'method' => 'destroy'
    ])->setMethods(['DELETE'])
);

return $routes;