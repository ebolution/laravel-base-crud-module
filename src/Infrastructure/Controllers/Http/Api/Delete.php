<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use App\Http\Controllers\Controller;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\DeleteByIdController;

class Delete extends Controller
{
    public function __construct(
        private DeleteByIdController $controller
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        $this->controller->__invoke($request, $id);

        return response('', 204);
    }
}