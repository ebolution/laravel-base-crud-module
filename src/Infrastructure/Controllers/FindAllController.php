<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\FindAllInterface;

class FindAllController implements ControllerInterface
{
    public function __construct(
        private readonly FindAllInterface $useCase
    ) {}

    public function __invoke(): array
    {
        return $this->useCase->__invoke();
    }
}
