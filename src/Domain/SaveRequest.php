<?php

namespace Ebolution\BaseCrudModule\Domain;

use Illuminate\Support\Facades\Request;

class SaveRequest extends Request
{
    public function __construct(
        private ?array $value,
        private string $date
    ) {}

    public function value(): ?array
    {
        return $this->value;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function handler(): array
    {
        return array_merge($this->value(), [
            'created_at'    => $this->date(),
            'updated_at'    => $this->date()
        ]);
    }
}
