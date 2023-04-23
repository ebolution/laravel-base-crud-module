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
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\UpdateInterface;
use Ebolution\Core\Infrastructure\Helpers\DateHelper;
use Illuminate\Http\Request;

class UpdateByIdController implements ControllerRequestByIdInterface
{
    use DateHelper;

    public function __construct(
        private readonly UpdateInterface $useCase
    ) {}

    public function __invoke(Request $request, int $id): array
    {
        return $this->useCase->__invoke($id, $request->all(), $this->getNow());
    }
}
