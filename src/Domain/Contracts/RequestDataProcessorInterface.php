<?php
/**
 * @category  Ebolution
 * @package   Ebolution/__MODULE__
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Domain\Contracts;

interface RequestDataProcessorInterface
{
    public function __invoke(array $request): array;
}