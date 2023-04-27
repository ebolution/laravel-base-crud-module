<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Contracts;

use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;

interface ValidatorLoaderInterface
{
    public function load(SaveRequest $request): void;
}
