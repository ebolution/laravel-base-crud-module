<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use App\Http\Controllers\Controller;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\FindByIdController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Get extends Controller
{
    public function __construct(
        private FindByIdController $userFindByIdController
    ) {}

    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        $user = $this->userFindByIdController->__invoke($request, $id);

        return response($user, 200);
    }
}
