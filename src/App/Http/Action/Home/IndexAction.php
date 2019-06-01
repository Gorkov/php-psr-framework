<?php

namespace App\Http\Action\Home;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

class IndexAction
{
    /**
     * @param ServerRequestInterface $request
     *
     * @return HtmlResponse
     */
    public function __invoke(ServerRequestInterface $request): HtmlResponse
    {
        $name = $request->getQueryParams()['name'] ?? 'Guest';

        return new HtmlResponse('Hello, ' . $name . '!');
    }
}
