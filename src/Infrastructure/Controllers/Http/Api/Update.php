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
use Ebolution\BaseCrudModule\Infrastructure\Contracts\ValidatorLoaderInterface;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Controller;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest as SaveRequest;
use Ebolution\Logger\Domain\LoggerFactoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Update extends Controller
{
    public function __construct(
        private readonly ControllerRequestByIdInterface $controller,
        private readonly ValidatorLoaderInterface $validator,
        private readonly LoggerFactoryInterface $loggerFactory
    ) {
        parent::__construct($this->loggerFactory);
    }

    public function __invoke(SaveRequest $request, $id): Response|Application|ResponseFactory
    {
        try {
            $this->validator->load($request);
            $response = $this->controller->__invoke($request, $id);

            return ($response['message'] === 'OK') ?
                response(['data' => $response], 200) :
                response($this->formatError(400, 'Unexpected result'), 400);
        } catch(\Exception $e) {
            return $this->handleException($e);
        }
    }
}
