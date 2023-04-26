<?php

namespace Ebolution\BaseCrudModule\Application\Read;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\FindByIdInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;

class FindByIdUseCase implements FindByIdInterface
{
    const EXCEPTION_MESSAGE = 'Entity not found';

    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(int $id): array
    {
        $response = $this->repository->findById(new Id($id));

        return $response;
    }
}
