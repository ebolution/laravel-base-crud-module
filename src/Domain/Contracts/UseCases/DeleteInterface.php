<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts\UseCases;

interface DeleteInterface
{
    public function __invoke(int $id): array;
}
