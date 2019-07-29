<?php

namespace App\Exceptions;


use Throwable;

class TaskManagerException extends \Exception
{

    public function __construct($messageCode = "", $parameters = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            MessageException::getMessage($messageCode, $parameters ?? []), $code, $previous
        );
    }
}