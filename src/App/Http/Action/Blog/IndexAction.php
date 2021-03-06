<?php

namespace App\Http\Action\Blog;

use Zend\Diactoros\Response\JsonResponse;

class IndexAction
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            ['id' => 2, 'title' => 'The Second Post'],
            ['id' => 1, 'title' => 'The First Post'],
        ]);
    }
}
