<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerRequestByIdInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\FindByIdInterface;
use Illuminate\Http\Request;

class FindByIdController implements ControllerRequestByIdInterface
{
    public function __construct(
        private readonly FindByIdInterface $useCase
    ) {}

    public function __invoke(Request $request, int $id): array
    {
        return $this->useCase->__invoke($id);
    }
}
