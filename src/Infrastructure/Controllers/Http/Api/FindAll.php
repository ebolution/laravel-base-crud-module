<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerInterface;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FindAll extends Controller
{
    public function __construct(
        private readonly ControllerInterface $controller
    ) {}

    public function __invoke(): Response|Application|ResponseFactory
    {
        try {
            $response = $this->controller->__invoke();

            return response(['data' => $response], 200);
        } catch(\Exception $e) {
            $status_code = $e instanceof HttpException ? $e->getStatusCode() : 400;
            return response( ['errors' => $e->getMessage()], $status_code);
        }
    }
}
