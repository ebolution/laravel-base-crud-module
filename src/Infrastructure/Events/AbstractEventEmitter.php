<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Events;

use Ebolution\BaseCrudModule\Domain\Contracts\EventEmitterInterface;

abstract class AbstractEventEmitter implements EventEmitterInterface
{
    protected array $mappings;

    public function emit(string $event, mixed $data): void
    {
        if ( array_key_exists($event, $this->mappings) ) {
            $event_class = $this->mappings[$event];
            event(new $event_class($data));

            return;
        }

        throw new \InvalidArgumentException('Event name is unknown');
    }
}
