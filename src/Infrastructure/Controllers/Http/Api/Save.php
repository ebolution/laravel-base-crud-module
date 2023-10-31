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
use Ebolution\BaseCrudModule\Infrastructure\Contracts\ValidatorLoaderInterface;
use Ebolution\BaseCrudModule\Infrastructure\Controllers\Http\Controller;
use Ebolution\BaseCrudModule\Infrastructure\Request\SaveRequest;
use Ebolution\Logger\Domain\LoggerFactoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class Save extends Controller
{
    public function __construct(
        private readonly ControllerSaveRequestInterface $controller,
        private readonly ValidatorLoaderInterface $validator,
        private readonly LoggerFactoryInterface $loggerFactory
    ) {
        parent::__construct($this->loggerFactory);
    }

    public function __invoke(SaveRequest $request): Response|Application|ResponseFactory
    {
        try {
            $this->validator->load($request);
            $newEntity = $this->controller->__invoke($request);

            return response(['data' => $newEntity], 200);
        } catch(\Exception $e) {
            return $this->handleException($e);
        }
    }
}
