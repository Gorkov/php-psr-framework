<?php

use App\Http\Middleware\ProfilerMiddleware;
use Framework\Http\Pipeline\Pipeline;
use Framework\Http\Router\RouteCollection;
use Framework\Http\Router\Router;
use App\Http\Action;
use Framework\Http\ActionResolver;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouteNotFoundException;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

### Initialization

$routes = new RouteCollection();

$routes->get('home', '/', Action\Home\IndexAction::class);
$routes->get('about', '/about', Action\About\IndexAction::class);
$routes->get('blog', '/blog', Action\Blog\IndexAction::class);
$routes->get('blog_show', '/blog/{id}', Action\Blog\ShowAction::class, ['id' => '\d+']);

$router = new Router($routes);
$resolver = new ActionResolver();
$pipeline = new Pipeline();

$pipeline->pipe($resolver->resolve(ProfilerMiddleware::class));

### Running

$request = ServerRequestFactory::fromGlobals();
try {
    $result = $router->match($request);
    foreach ($result->getAttributes() as $attribute => $value) {
        $request = $request->withAttribute($attribute, $value);
    }
    $action = $resolver->resolve($result->getHandler());
    $response = $pipeline($request, $action);
} catch (RequestNotMatchedException|RouteNotFoundException $e){
    $response = new HtmlResponse('Undefined page', 404);
}

### Postprocessing

$response = $response->withHeader('X-Developer', 'asGorkov');

### Sending

$emitter = new SapiEmitter();
$emitter->emit($response);
