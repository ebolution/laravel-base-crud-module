<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Ebolution\BaseCrudModule\Application\Delete\DeleteByIdUseCase as DeleteByIdUseCase;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use JetBrains\PhpStorm\ArrayShape;

abstract class DeleteByIdController
{
    public function __construct(
        private DeleteByIdUseCase $useCase
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string"])]
    public function __invoke(Request $request, int $id): array
    {
        return $this->useCase->__invoke($id);
    }
}
