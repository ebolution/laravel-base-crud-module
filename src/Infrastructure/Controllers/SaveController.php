<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerSaveRequestInterface;
use Ebolution\BaseCrudModule\Domain\Contracts\UseCases\CreateInterface;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Ebolution\Core\Infrastructure\Helpers\DateHelper;
use JetBrains\PhpStorm\ArrayShape;

class SaveController implements ControllerSaveRequestInterface
{
    use DateHelper;

    public function __construct(
        private readonly CreateInterface $useCase
    ) {}

    #[ArrayShape(['message' => "string", 'id' => "\int|null"])]
    public function __invoke(SaveRequest $request): array
    {
        return $this->useCase->__invoke($request->all(), $this->getNow());
    }
}
