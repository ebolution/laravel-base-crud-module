<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts\UseCases;

interface UpdateInterface
{
    public function __invoke(int $id, array $request, string $date): array;
}