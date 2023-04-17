<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Application\Find\FindAllUseCase;

class FindAllController
{
    public function __construct(
        private FindAllUseCase $findAllUseCase
    ) {}

    public function __invoke(): array
    {
        return $this->findAllUseCase->__invoke();
    }
}
