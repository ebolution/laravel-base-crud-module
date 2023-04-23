<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts\UseCases;

interface CreateInterface
{
    public function __invoke(array $request, string $date): array;
}