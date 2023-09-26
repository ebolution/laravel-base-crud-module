<?php

namespace Ebolution\BaseCrudModule\Domain\ValueObjects;

use Ebolution\BaseCrudModule\Domain\AbstractValueObjects;

class NullableId
{
    public function __construct(
        private ?string $value
    ) {
        $this->value = $value;
    }

    public function value(): ?string
    {
        return $this->value;
    }

    public function is_null(): bool
    {
        return is_null($this->value);
    }
}
