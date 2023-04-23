<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts\UseCases;

interface FindByIdInterface
{
    public function __invoke(int $id): array;
}