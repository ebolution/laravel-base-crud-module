<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Events;

class NullEventEmitter extends AbstractEventEmitter
{
    public function emit(string $event, mixed $data): void
    {
    }
}
