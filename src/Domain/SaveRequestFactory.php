<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Domain;

class SaveRequestFactory implements Contracts\SaveRequestFactoryInterface
{
    public function create(?array $value, string $date)
    {
        return new SaveRequest($value, $date);
    }
}