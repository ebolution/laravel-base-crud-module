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
use Ebolution\Logger\Domain\LoggerFactoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Find extends Controller
{
    public function __construct(
        private readonly ControllerRequestByIdInterface $controller,
        private readonly LoggerFactoryInterface $loggerFactory
    ) {
        parent::__construct($this->loggerFactory);
    }

    public function __invoke(Request $request, $id): Response|Application|ResponseFactory
    {
        try {
            $user = $this->controller->__invoke($request, $id);

            return response(['data' => $user], 200);
        } catch(\Exception $e) {
            return $this->handleException($e);
        }
    }
}
