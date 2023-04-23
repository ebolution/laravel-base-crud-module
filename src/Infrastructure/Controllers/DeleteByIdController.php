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
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\DeleteInterface;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;

abstract class DeleteByIdController implements ControllerRequestByIdInterface
{
    public function __construct(
        private readonly DeleteInterface $useCase
    ) {}

    #[ArrayShape(['message' => "string"])]
    public function __invoke(Request $request, int $id): array
    {
        return $this->useCase->__invoke($id);
    }
}
