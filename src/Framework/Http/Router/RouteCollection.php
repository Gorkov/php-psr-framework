<?php

namespace Framework\Http\Router;

use Framework\Http\Router\Route\RegexpRoute;
use Framework\Http\Router\Route\Route;

class RouteCollection
{
    /**
     * @var array
     */
    private $routes = [];

    /**
     * @param Route $route
     */
    public function addRoute(Route $route): void
    {
        $this->routes[] = $route;
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param mixed  $handler
     * @param array  $methods
     * @param array  $tokens
     */
    public function add(string $name, string $pattern, $handler, array $methods, array $tokens = []): void
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, $methods, $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param mixed  $handler
     * @param array  $tokens
     */
    public function any(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, [], $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param mixed  $handler
     * @param array  $tokens
     */
    public function get(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, ['GET'], $tokens));
    }

    /**
     * @param string $name
     * @param string $pattern
     * @param mixed  $handler
     * @param array  $tokens
     */
    public function post(string $name, string $pattern, $handler, array $tokens = []): void
    {
        $this->addRoute(new RegexpRoute($name, $pattern, $handler, ['POST'], $tokens));
    }

    /**
     * @return RegexpRoute[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}
