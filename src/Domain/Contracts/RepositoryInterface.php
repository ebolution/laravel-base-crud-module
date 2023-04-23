<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts;

use Ebolution\BaseCrudModule\Domain\SaveRequest;
use Ebolution\BaseCrudModule\Domain\ValueObjects\Id;

interface RepositoryInterface
{
    public function findAll(): array;
    public function findById(Id $id): ?array;
    public function deleteById(Id $id): bool;
    public function create(SaveRequest $request): ?int;
    public function updateById(Id $id, SaveRequest $request): ?int;
}
