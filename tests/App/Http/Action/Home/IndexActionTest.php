<?php

namespace Tests\App\Http\Action\Home;

use App\Http\Action\Home\IndexAction;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;

class IndexActionTest extends TestCase
{
    public function testGuest()
    {
        $action = new IndexAction();

        $request = new ServerRequest();
        $response = $action($request);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('Hello, Guest!', $response->getBody()->getContents());
    }

    public function testJohn()
    {
        $action = new IndexAction();

        $request = (new ServerRequest())
            ->withQueryParams(['name' => 'Mark']);

        $response = $action($request);

        self::assertEquals('Hello, Mark!', $response->getBody()->getContents());
    }
}
