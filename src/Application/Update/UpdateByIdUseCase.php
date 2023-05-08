<?php

namespace Ebolution\BaseCrudModule\Application\Update;

use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;
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
        private readonly RequestDataProcessorInterface $requestDataProcessor,
        private readonly RepositoryInterface $repository
    ) {}

    /**
     * @throws EntityException
     */
    #[ArrayShape(['message' => "string", 'id' => "int|null"])]
    public function __invoke(int $id, array $request, string $date): array
    {
        $request = $this->requestDataProcessor->__invoke($request);
        try {
            $response = $this->repository->updateById(
                new Id($id),
                new SaveRequest($request, $date)
            );
        } catch(Exception $e) {
            return [static::EXCEPTION_MESSAGE, 500];
        }

        return [
            'message'   => 'OK',
            'id'        => $response
        ];
    }
}
