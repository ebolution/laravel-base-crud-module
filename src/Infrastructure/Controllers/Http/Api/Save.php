<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerSaveRequestInterface;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Controller;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Save extends Controller
{
    public function __construct(
        private readonly ControllerSaveRequestInterface $controller
    ) {}

    public function __invoke(SaveRequest $request): Response|Application|ResponseFactory
    {
        $newEntity = $this->controller->__invoke($request);

        return response($newEntity, 200);
    }
}
