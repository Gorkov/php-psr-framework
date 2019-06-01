<?php

namespace App\Http\Action\About;

use Zend\Diactoros\Response\HtmlResponse;

class IndexAction
{
    /**
     * @return HtmlResponse
     */
    public function __invoke(): HtmlResponse
    {
        return new HtmlResponse('I am a simple site');
    }
}
