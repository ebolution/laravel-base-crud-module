<?php

namespace Ebolution\BaseCrudModule\Application\Create;

use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\SaveRequestFactoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\CreateInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class CreateUseCase implements CreateInterface
{
    const EXCEPTION_MESSAGE = 'Entity not created';

    public function __construct(
        private readonly RepositoryInterface $repository,
        private readonly SaveRequestFactoryInterface $factoryInterface
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(array $request, string $date): array
    {
        $saveRequest = $this->factoryInterface->create($request, $date);
        try {
            $entityId = $this->repository->create($saveRequest);
        } catch (Exception $e) {
            throw new EntityException(static::EXCEPTION_MESSAGE . " - " . $e->getMessage(), 500);
        }

        return $this->repository->findById(new Id($entityId));
    }
}
