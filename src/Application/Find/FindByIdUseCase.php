<?php

namespace Ebolution\BaseCrudModule\Application\Find;

use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;

class FindByIdUseCase
{
    const EXCEPTION_MESSAGE = 'Entity not found';

    public function __construct(
        private RepositoryInterface $repository
    ) {}

    /**
     * @throws EntityException
     */
    public function __invoke(int $id): array
    {
        $response = $this->repository->findById(new Id($id));
        if (! $response) {
            throw new EntityException(static::EXCEPTION_MESSAGE, 404);
        }

        return $response;
    }
}
