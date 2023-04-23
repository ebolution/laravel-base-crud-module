<?php

namespace Ebolution\BaseCrudModule\Domain\Contracts;

use Illuminate\Http\Request;

interface ControllerRequestByIdInterface
{
    public function __invoke(Request $request, int $id): array;
}