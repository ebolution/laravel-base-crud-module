<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Illuminate\Http\Request;
use Ebolution\BaseCrudModule\Application\Update\UpdateByIdUseCase as UpdateByIdUseCase;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\Core\Infrastructure\Helpers\DateHelper;

class UpdateByIdController
{
    use DateHelper;

    public function __construct(
        private UpdateByIdUseCase $updateByIdUseCase
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(Request $request, int $id): array
    {
        return $this->updateByIdUseCase->__invoke($id, $request->all(), $this->getNow());
    }
}
