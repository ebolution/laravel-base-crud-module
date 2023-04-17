<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use App\Http\Controllers\Controller;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\SaveController;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Create extends Controller
{
    public function __construct(
        private SaveController $saveController
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(SaveRequest $request): Response|Application|ResponseFactory
    {
        $newEntity = $this->saveController->__invoke($request);

        return response($newEntity, 200);
    }
}
