<?php

namespace Ebolution\BaseCrudModule\Application\Create;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\SaveRequestFactoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\CreateInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Ebolution\Logger\Domain\LoggerFactoryInterface;
use Ebolution\Logger\Domain\LoggerInterface;
use Ebolution\Logger\Infrastructure\Logger;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class CreateUseCase implements CreateInterface
{
    const EXCEPTION_MESSAGE = 'Entity not created';

    protected Logger $logger;
    protected array $created_events = [];

    public function __construct(
        private readonly RequestDataProcessorInterface $requestDataProcessor,
        private readonly RepositoryInterface $repository,
        private readonly SaveRequestFactoryInterface $factoryInterface,
        private readonly EventEmitterInterface $eventEmitter,
        private readonly LoggerFactoryInterface $loggerFactory
    ) {
        $this->logger = $this->loggerFactory->create();
    }

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
            ($this->logger)("Unexpected error" .
                " code " . $e->getCode() .
                " [" . $e->getMessage() . "]" .
                " catch by " . get_class($this) .
                " was thrown on file " . $e->getFile() .
                "(" . $e->getLine() . ")" .
                "\n[stacktrace]\n" . $e->getTraceAsString()
                , 'error');
            throw new EntityException(static::EXCEPTION_MESSAGE, 500, $e);
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
