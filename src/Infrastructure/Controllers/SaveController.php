<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Application\Save\SaveUseCase;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Ebolution\Core\Infrastructure\Helpers\DateHelper;
use JetBrains\PhpStorm\ArrayShape;

class SaveController
{
    use DateHelper;

    public function __construct(
        private SaveUseCase $saveUseCase
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "\int|null"])]
    public function __invoke(SaveRequest $request): array
    {
        return $this->saveUseCase->__invoke($request->all(), $this->getNow());
    }
}
