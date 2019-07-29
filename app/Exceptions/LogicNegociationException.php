<?php

namespace App\Exceptions;


use Throwable;

class LogicNegociationException extends TaskManagerException
{

    public function __construct($messageCode = "", array $parameters = [], $code = 409, Throwable $previous = null)
    {
        parent::__construct($messageCode, $parameters, $code, $previous);
    }
}