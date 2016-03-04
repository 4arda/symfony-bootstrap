<?php

namespace ApiBundle\Controller;

use ApiBundle\Exception\ExceptionNotFoundException;
use ApiBundle\Exception\HttpException;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class RestController
 * @package ApiBundle\Controller
 */
abstract class RestController extends FOSRestController
{
    /**
     * @param $name
     * @throws ExceptionNotFoundException
     * @return HttpException
     */
    public function createException($name)
    {
        $exceptions = $this->container->getParameter('exceptions');

        if (!array_key_exists($name, $exceptions)) {
            throw new ExceptionNotFoundException($name);
        }

        $exception = $exceptions[$name];

        return new HttpException($exception['http_code'], $exception['error_code'], $exception['message']);
    }

    /**
     * @param $httpCode
     * @param $message
     * @param int $applicationCode
     * @return HttpException
     */
    public function forgeException($httpCode, $message, $applicationCode = 0)
    {
        return new HttpException($httpCode, $applicationCode, $message);
    }
}