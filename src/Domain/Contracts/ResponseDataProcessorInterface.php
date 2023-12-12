<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Domain\Contracts;

interface ResponseDataProcessorInterface
{
    public function __invoke(?array $response): array;
}
