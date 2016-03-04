<?php

namespace ApiBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException as HttpKernelException;

/**
 * Class ExceptionNotFound
 * @package ApiBundle\Exception
 */
class ExceptionNotFoundException extends HttpKernelException
{
    public function __construct($exceptionName)
    {
        parent::__construct(500, 'Exception "' . $exceptionName . '" not found', null, array(), 0);
    }

}