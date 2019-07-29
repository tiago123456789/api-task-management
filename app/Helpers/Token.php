<?php

namespace App\Helpers;


use App\Config\App;

class Token
{

    static public function getWithoutPrefix($accessToken)
    {
        return str_replace(App::PARAM_PREFIX_TOKEN, "", $accessToken);
    }

    static public function getWithPrefix($accessToken)
    {
        return App::PARAM_PREFIX_TOKEN . $accessToken;
    }

    static public function getValueInPayload($key, $accessToken)
    {
        $positionPayload = 1;
        $jwt = explode(".", $accessToken);
        $payload = $jwt[$positionPayload];
        $payload = json_decode(base64_decode($payload), true);
        return $payload[$key];
    }

    static public function isExpired($accessToken) {
        $valueTimeExpired = 0;
        $jwt = explode(".", $accessToken);
        $isJwt = count($jwt) == 3;
        if (!$isJwt) {
            return true;
        }
        $payload = $jwt[1];
        $payload = json_decode(base64_decode($payload), true);
        $dateExpire = $payload["exp"];
        $timeStampNow = (new \DateTime())->getTimestamp();
        return ($dateExpire - $timeStampNow) <= $valueTimeExpired;
    }
}