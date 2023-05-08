<?php

namespace Ebolution\BaseCrudModule\Application\Collaborator;

use Ebolution\BaseCrudModule\Domain\Contracts\RequestDataProcessorInterface;

class RequestDataProcessor implements RequestDataProcessorInterface
{
    public function __invoke(array $request): array
    {
        return $request;
    }
}
