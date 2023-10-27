<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Application\Events;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;

abstract class AbstractEvent
{
    protected string $name;

    public function __construct(
        private readonly EventEmitterInterface $emitter
    ) {}

    public function __invoke(array $data): void
    {
        $this->emitter->emit($this->name, $data);
    }
}
