<?php

namespace Ebolution\BaseCrudModule\Application\Find;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;

class FindAllUseCase
{
    public function __construct(
        private RepositoryInterface $repository
    ) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
