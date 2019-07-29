<?php

namespace App\Exceptions;


use Throwable;

class NotFoundException extends TaskManagerException
{

    public function __construct($messageCode = "", array $parameters = [], $code = 404, Throwable $previous = null)
    {
        parent::__construct($messageCode, $parameters, $code, $previous);
    }
}