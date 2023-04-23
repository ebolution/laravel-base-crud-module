<?php

namespace Ebolution\BaseCrudModule\Application\Update;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\UpdateInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\SaveRequest;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class UpdateByIdUseCase implements UpdateInterface
{
    const EXCEPTION_MESSAGE = 'Entity not updated';

    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(int $id, array $request, string $date): array
    {
        try {
            $response = $this->repository->updateById(
                new Id($id),
                new SaveRequest($request, $date)
            );
        } catch(Exception $e) {
            throw new EntityException(static::EXCEPTION_MESSAGE, 404);
        }

        return [
            'message'   => 'OK',
            'id'        => $response
        ];
    }
}
