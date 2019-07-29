<?php

namespace App\Http\Middleware;

use App\Config\App;
use App\Helpers\Token;
use Closure;

class AuthenticatorAuthorizator
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
        $accessToken = $request->header(App::PARAM_AUTH);

        if (!$accessToken) {
            return response()->json([
                "statusCode" => 401,
                "message" => "Unauthorization"
            ], 401);
        }

        if (Token::isExpired($accessToken)) {
            return response()->json([
                "statusCode" => 403,
                "message" => "Forbidden"
            ], 403);
        }

        return $next($request);
    }
}
