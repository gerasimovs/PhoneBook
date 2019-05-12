<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class Router
{
    protected $routes;

    public function __construct()
    {
        $rootCollection = new RouteCollection();

        $apiCollection = require_once __DIR__ . '/../routes/api.php';
        $webCollection = require_once __DIR__ . '/../routes/web.php';

        $this->routes = $rootCollection->addCollection($apiCollection);
        $this->routes = $rootCollection->addCollection($webCollection);
        $this->routes = $rootCollection;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Symfony\Component\Routing\Exception\ResourceNotFoundException
     */
    public function match(Request $request)
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);
        
        /** @todo Set redirect for route with slashes */
        $parameters = $matcher->matchRequest($request);

        return $parameters;
    }
}
