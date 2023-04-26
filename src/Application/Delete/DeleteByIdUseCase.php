<?php

namespace Ebolution\BaseCrudModule\Application\Delete;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\DeleteInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use JetBrains\PhpStorm\ArrayShape;

class DeleteByIdUseCase implements DeleteInterface
{
    const EXCEPTION_MESSAGE = 'Entity not deleted';

    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string"])]
    public function __invoke(int $id): array
    {
        $response = $this->repository->deleteById(new Id($id));
        if (! $response) {
            return (['message' => static::EXCEPTION_MESSAGE, 404]);
//            throw new EntityException(static::EXCEPTION_MESSAGE, 500);
        }

        return [
            'message' => 'OK'
        ];
    }
}
