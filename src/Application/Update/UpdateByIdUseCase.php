<?php

namespace Ebolution\BaseCrudModule\Application\Update;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\UpdateInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityNotFoundException;
use Ebolution\BaseCrudModule\Domain\SaveRequest;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class UpdateByIdUseCase implements UpdateInterface
{
    const EXCEPTION_MESSAGE = 'Entity not updated';

    protected array $updating_events = [];
    protected array $updated_events = [];

    public function __construct(
        private readonly RequestDataProcessorInterface $requestDataProcessor,
        private readonly RepositoryInterface $repository,
        private readonly EventEmitterInterface $eventEmitter
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(int $id, array $request, string $date): array
    {
        $request = $this->requestDataProcessor->__invoke($request);
        try {
            $this->emitEvents($this->updating_events, $id, $request);

            $response = $this->repository->updateById(
                new Id($id),
                new SaveRequest($request, $date)
            );

            $this->emitEvents($this->updated_events, $id, $request);
        } catch (EntityNotFoundException $e) {
            throw new EntityException(static::EXCEPTION_MESSAGE, 404);
        } catch (Exception $e) {
            //TODO: Log real exception
            throw new EntityException(static::EXCEPTION_MESSAGE, 500);
        }

        return [
            'message'   => 'OK',
            'id'        => $response
        ];
    }

    protected function emitEvents($events, int $id, array $request): void
    {
        foreach ($events as $event) {
            $event_handler = new $event($this->eventEmitter);
            $event_handler(array_merge(['id' => $id], $request));
        }
    }
}
