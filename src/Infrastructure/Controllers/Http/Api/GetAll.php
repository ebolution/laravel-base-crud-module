<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use App\Http\Controllers\Controller;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\FindAllController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class GetAll extends Controller
{
    public function __construct(
        private FindAllController $userFindAllController
    ) {}

    public function __invoke(): Response|Application|ResponseFactory
    {
        $user = $this->userFindAllController->__invoke();

        return response($user, 200);
    }
}
