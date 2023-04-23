<?php

namespace Ebolution\BaseCrudModule\Application\Read;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\FindAllInterface;

class FindAllUseCase implements FindAllInterface
{
    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    public function __invoke(): array
    {
        return $this->repository->findAll();
    }
}
