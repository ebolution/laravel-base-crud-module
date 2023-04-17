<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\UpdateByIdController as UpdateByIdController;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest as SaveRequest;

class Update extends Controller
{
    public function __construct(
        private UpdateByIdController $updateByIdController
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(SaveRequest $request, $id): Response|Application|ResponseFactory
    {
        $object = $this->updateByIdController->__invoke($request, $id);

        return response($object, 200);
    }
}
