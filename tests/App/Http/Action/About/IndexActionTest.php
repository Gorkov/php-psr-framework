<?php

namespace Tests\App\Http\Action\About;

use App\Http\Action\About\IndexAction;
use PHPUnit\Framework\TestCase;

class IndexActionTest extends TestCase
{
    public function testGuest()
    {
        $action = new IndexAction();
        $response = $action();

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals('I am a simple site', $response->getBody()->getContents());
    }
}
