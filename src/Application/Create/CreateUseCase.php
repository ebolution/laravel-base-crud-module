<?php

namespace Ebolution\BaseCrudModule\Application\Create;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\SaveRequestFactoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\CreateInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class CreateUseCase implements CreateInterface
{
    const EXCEPTION_MESSAGE = 'Entity not created';

    protected array $created_events = [];

    public function __construct(
        private readonly RequestDataProcessorInterface $requestDataProcessor,
        private readonly RepositoryInterface $repository,
        private readonly SaveRequestFactoryInterface $factoryInterface,
        private readonly EventEmitterInterface $eventEmitter,
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(array $request, string $date): array
    {
        $request = $this->requestDataProcessor->__invoke($request);
        $saveRequest = $this->factoryInterface->create($request, $date);
        try {
            $entityId = $this->repository->create($saveRequest);

            $this->emitEvents($this->created_events, $entityId, $request);
        } catch (Exception $e) {
            //TODO: Log real exception
            throw new EntityException(static::EXCEPTION_MESSAGE, 500);
        }

        return $this->repository->findById(new Id($entityId));
    }

    protected function emitEvents(array $events, int $id, array $data): void
    {
        foreach ($events as $event) {
            $event_handler = new $event($this->eventEmitter);
            $event_handler(array_merge(['id' => $id], $data));
        }
    }
}
