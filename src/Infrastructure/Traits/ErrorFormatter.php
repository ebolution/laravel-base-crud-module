<?php
/**
 * @category  Ebolution
 * @package   Ebolution/BaseCrudModule
 * @author    Carlos Cid <carlos.cid@ebolution.com>
 * @copyright 2023 Avanzed Cloud Develop S.L
 * @license   Private - https://www.ebolution.com/
 */

namespace Ebolution\BaseCrudModule\Infrastructure\Traits;

trait ErrorFormatter
{
    /**
     * Format an error string according to JSON:API standard
     *
     * @param int|string $status Status code
     * @param string $message Error message. May contain several error messages delimited by '|'
     * @return array[] JSON:API formatted errors object
     */
    public function formatError(int|string $status, string $message): array
    {
        $result = [];
        $errors = explode('|', $message);
        foreach ($errors as $error) {
            $result[] = [
                'status' => strval($status),
                'title' => $error,
            ];
        }

        return [ 'errors' => $result ];
    }
}
