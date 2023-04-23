<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts\UseCases;

interface FindAllInterface
{
    public function __invoke(): array;
}