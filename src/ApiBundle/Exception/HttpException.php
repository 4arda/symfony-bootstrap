<?php

namespace ApiBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;

/**
 * Class NoAccessException
 * @package ApiBundle\Exception
 */
class HttpException extends HttpKernelException
{
    public function __construct($httpCode, $applicationCode = 0, $message = null, \Exception $previous = null)
    {
        parent::__construct($httpCode, $message, $previous, array(), $applicationCode);
    }

}