<?php

namespace Ebolution\BaseCrudModule\Application\Save;

use Ebolution\BaseCrudModule\Domain\Contracts\SaveRequestFactoryInterface;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use JetBrains\PhpStorm\ArrayShape;

class SaveUseCase
{
    const EXCEPTION_MESSAGE = 'Entity not created';

    public function __construct(
        private RepositoryInterface $repository,
        private SaveRequestFactoryInterface $factoryInterface
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(array $request, string $date): array
    {
        $saveRequest = $this->factoryInterface->create($request, $date);
        try {
            $entityId = $this->repository->save($saveRequest);
        } catch (Exception $e) {
            throw new EntityException(static::EXCEPTION_MESSAGE . " - " . $e->getMessage(), 500);
        }

        return $this->repository->findById(new Id($entityId));
    }
}
