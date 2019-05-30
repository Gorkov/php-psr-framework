<?php

namespace Framework\Http\Router;

use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var RouteCollection
     */
    private $routes;

    /**
     * Router constructor.
     *
     * @param RouteCollection $routes
     */
    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return Result
     * @throws \ErrorException
     */
    public function match(ServerRequestInterface $request): Result
    {
        foreach ($this->routes->getRoutes() as $route) {
            if ($result = $route->match($request)) {
                return $result;
            }
        }

        throw new \ErrorException('Matches not found.');
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return string
     * @throws \ErrorException
     */
    public function generate(string $name, array $params = []): string
    {
        foreach ($this->routes->getRoutes() as $route) {
            if (null !== $url = $route->generate($name, array_filter($params))) {
                return $url;
            }
        }

        throw new \ErrorException('Route "' . $name . '" not found.');
    }
}
