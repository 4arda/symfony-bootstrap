<?php

namespace ApiBundle\Util;


use Symfony\Component\Form\FormInterface;

class ExceptionWrapper
{
    private $errorCode;
    private $httpCode;
    private $message;
    private $errors;

    /**
     * @param array $data
     */
    public function __construct($data)
    {
        $this->httpCode = $data['status_code'];
        $this->message = $data['message'];

        if (isset($data['errors'])) {
            $this->errors = $data['errors'];
        }

        $this->errorCode = $data['code'];
    }

    /**
     * @return FormInterface
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param mixed $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }
}