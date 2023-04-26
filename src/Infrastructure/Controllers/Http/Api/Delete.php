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

class Delete extends Controller
{
    public function __construct(
        private readonly ControllerRequestByIdInterface $controller
    ) {}

    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        $response = $this->controller->__invoke($request, $id);
        if($response['message'] === 'OK')return response('OK', 204);
        else return response('ERROR', 404);
    }
}
