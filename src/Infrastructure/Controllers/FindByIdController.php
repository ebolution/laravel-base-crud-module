<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Application\Find\FindByIdUseCase;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Illuminate\Http\Request;

class FindByIdController
{
    public function __construct(
        private FindByIdUseCase $findByIdUseCase
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(Request $request, int $id): array
    {
        return $this->findByIdUseCase->__invoke($id);
    }
}
