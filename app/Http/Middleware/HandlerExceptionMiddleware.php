<?php

namespace App\Http\Middleware;

use App\Exceptions\TaskManagerException;
use Closure;
use Illuminate\Validation\ValidationException;

class HandlerExceptionMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->exception instanceof ValidationException) {
            return response()->json([
                "message" => $this->getMessageValidation($response->exception),
                "statusCode" => 400
            ], 400);
        }

        if ($response->exception instanceof TaskManagerException) {
            $exception = $response->exception;
            return response()->json([
                "message" => $exception->getMessage(),
                "statusCode" => $exception->getCode()
            ], $exception->getCode());
        } else {
            return $response;
        }

    }

    private function getMessageValidation($exception)
    {
        $messages = [];
        foreach ($exception->errors() as $key => $error) {
            $messages[$key] = $error[0];
        }
        return $messages;
    }
}