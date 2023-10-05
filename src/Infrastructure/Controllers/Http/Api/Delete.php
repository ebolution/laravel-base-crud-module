<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Api;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerRequestByIdInterface;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Delete extends Controller
{
    public function __construct(
        private readonly ControllerRequestByIdInterface $controller
    ) {}

    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        try {
            $response = $this->controller->__invoke($request, $id);
            return ($response['message'] === 'OK') ?
                response(['data' => 'OK'], 204) :
                response(['data' => 'NOT FOUND'], 404);
        } catch(\Exception $e) {
            $status_code = $e instanceof HttpException ? $e->getStatusCode() : 400;
            return response( ['errors' => $e->getMessage()], $status_code);
        }
    }
}
