<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts;

interface ControllerInterface
{
    public function __invoke(): array;
}