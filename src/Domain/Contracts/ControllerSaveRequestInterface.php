<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts;

use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;

interface ControllerSaveRequestInterface
{
    public function __invoke(SaveRequest $request): array;
}