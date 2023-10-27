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
use Ebolution\BaseCrudModule\Infrastructure\Traits\ErrorFormatter;
use Ebolution\Core\Domain\Exceptions\CustomException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Find extends Controller
{
    use ErrorFormatter;

    public function __construct(
        private readonly ControllerRequestByIdInterface $controller
    ) {}

    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        try {
            $user = $this->controller->__invoke($request, $id);

            return response(['data' => $user], 200);
        } catch(\Exception $e) {
            $status_code = $e instanceof HttpException ? $e->getStatusCode() :
                ($e instanceof CustomException ? $e->getCode() : 400);
            return response($this->formatError($status_code, $e->getMessage()), $status_code);
        }
    }
}
