<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Manuel GARCÍA SOLIPA <manuel.garcia@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Controllers\Http;

use Ebolution\BaseCrudModule\Domain\Contracts\ControllerRequestByIdInterface;
use Ebolution\BaseCrudModule\Infrastructure\Traits\ErrorFormatter;
use Ebolution\Core\Domain\Exceptions\CustomException;
use Ebolution\Logger\Domain\LoggerFactoryInterface;
use Ebolution\Logger\Infrastructure\Logger;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ErrorFormatter;

    protected Logger $logger;

    public function __construct(
        private readonly LoggerFactoryInterface $loggerFactory
    ) {
        $this->logger = $this->loggerFactory->create();
    }

    protected function handleException(Exception $e): Response
    {
        ($this->logger)("Unexpected error" .
            " code " . $e->getCode() .
            " [" . $e->getMessage() . "]" .
            " catch by " . get_class($this) .
            " was thrown on file " . $e->getFile() .
            "(" . $e->getLine() . ")" .
            "\n[stacktrace]\n" . $e->getTraceAsString()
            , 'error');

        $status_code = $e instanceof HttpException ? $e->getStatusCode() :
            ($e instanceof CustomException ? $e->getCode() : 400);
        return response($this->formatError($status_code, $e->getMessage()), $status_code);
    }
}
