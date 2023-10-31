<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Logger;

use Ebolution\Logger\Domain\LoggerBuilder;

class DefaultLoggerBuilder extends LoggerBuilder
{
    public function __construct()
    {
        $this->driver = config('ebolution-laravel-nutt.logging.default.driver', 'single');
        $this->path = config('ebolution-laravel-nutt.logging.default.path', 'logs/laravel.log');
        $this->prefix = config('ebolution-laravel-nutt.logging.default.prefix', '');
    }
}
