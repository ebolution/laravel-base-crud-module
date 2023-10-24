<?php

namespace Ebolution\BaseCrudModule\Application\Delete;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\RepositoryInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\DeleteInterface;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;
use Exception;
use JetBrains\PhpStorm\ArrayShape;

class DeleteByIdUseCase implements DeleteInterface
{
    const EXCEPTION_MESSAGE = 'Entity not deleted';

    protected array $deleting_events = [];
    protected array $deleted_events = [];

    public function __construct(
        private readonly RepositoryInterface $repository,
        private readonly EventEmitterInterface $eventEmitter
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string"])]
    public function __invoke(int $id): array
    {
        try {
            $this->emitEvents($this->deleting_events, $id);

            $response = $this->repository->deleteById(new Id($id));
            if (! $response) {
                return (['message' => static::EXCEPTION_MESSAGE, 404]);
            }

            $this->emitEvents($this->deleted_events, $id);
        } catch(Exception $e) {
            return [static::EXCEPTION_MESSAGE, 500];
        }

        return [
            'message' => 'OK'
        ];
    }

    protected function emitEvents($events, int $id): void
    {
        foreach ($events as $event) {
            $event_handler = new $event($this->eventEmitter);
            $event_handler(['id' => $id]);
        }
    }
}
