<?php

namespace App;

use Exception;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Application
{
    protected $path;
    protected $router;
    protected static $instance;

    public function __construct($path)
    {
        $dotenv = Dotenv::create($path);
        $dotenv->load();

        $this->path = $path;
        $this->router = new Router;
        
        self::$instance = $this;
    }

    public static function getInstance()
    {
        return self::$instance;
    }

    public function getPath($dir = '/')
    {
        return realpath($this->path . '/' . $dir);
    }

    public function handle($request)
    {
        try {
            $parameters = $this->router->match($request);

            if (isset($parameters['_route'])) {
                unset($parameters['_route']);
            }

            $controller = new $parameters['controller'];
            unset($parameters['controller']);

            $method = $parameters['method'];
            unset($parameters['method']);

            /** @todo Use reflection to pass dynamic parameters */
            if (!empty($parameters)) {
                $result = $controller->$method($request, ...array_values($parameters));
            } else {
                $result = $controller->$method($request);
            }
            
            $response = new Response($result);
        } catch (ResourceNotFoundException $e) {
            $response = new Response(
                $e->getMessage(), 
                Response::HTTP_NOT_FOUND
            );
        } catch (Exception $e) {
            $response = new Response(
                $e->getMessage(), 
                Response::HTTP_BAD_REQUEST
            );
        }

        return $response;
    }
}
